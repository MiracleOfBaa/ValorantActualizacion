<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReplyLike extends Model
{
    protected $fillable = [
        'user_id',
        'reply_id',
    ];

    /**
     * Relación con la respuesta (un like pertenece a una respuesta).
     */
    public function reply()
    {
        return $this->belongsTo(Reply::class, 'reply_id', 'id');
    }

    /**
     * Relación con el usuario (un like pertenece a un usuario).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
