<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $comment_id
 * @property int $user_id
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Comment $comment
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reply newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reply newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reply query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reply whereCommentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reply whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reply whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reply whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reply whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reply whereUserId($value)
 * @mixin \Eloquent
 */
class Reply extends Model
{
    protected $fillable = [
        'user_id',
        'comment_id',
        'content',
    ];

    /**
     * Relación con el comentario (una respuesta pertenece a un comentario).
     */
    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id', 'id');
    }

    /**
     * Relación con el usuario (una respuesta pertenece a un usuario).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Obtener todos los likes de la respuesta.
     */
    public function likes()
    {
        return $this->hasMany(ReplyLike::class, 'reply_id', 'id');
    }
}
