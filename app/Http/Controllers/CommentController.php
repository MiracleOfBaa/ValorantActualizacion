<?php

namespace App\Http\Controllers;

use App\Models\Agents;
use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $agentId)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $agent = Agents::findOrFail($agentId);

        $comment = new Comment();
        $comment->content = $request->comment;
        $comment->user_id = auth()->id();
        $comment->agent_id = $agent->id;
        $comment->save();

        return back();
    }

    public function like($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->likes_count += 1;
        $comment->save();

        return back();
    }

    public function reply(Request $request, $commentId)
    {
        $request->validate([
            'reply' => 'required|string|max:1000',
        ]);

        $comment = Comment::findOrFail($commentId);

        $reply = new Reply();
        $reply->content = $request->reply;
        $reply->user_id = auth()->id();
        $reply->comment_id = $comment->id;
        $reply->save();

        return back();
    }
}
