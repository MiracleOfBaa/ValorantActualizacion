<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $user_id
 * @property int $comment_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Comment $comment
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CommentLike newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CommentLike newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CommentLike query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CommentLike whereCommentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CommentLike whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CommentLike whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CommentLike whereUserId($value)
 * @mixin \Eloquent
 */
class CommentLike extends Model
{
    protected $fillable = [
        'user_id',
        'comment_id',
    ];

    /**
     * Relación con el comentario (un like pertenece a un comentario).
     */
    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id', 'id');
    }

    /**
     * Relación con el usuario (un like pertenece a un usuario).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
