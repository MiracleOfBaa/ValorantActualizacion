<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
