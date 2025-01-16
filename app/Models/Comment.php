<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Agents;
class Comment extends Model
{
    protected $table = 'comments';  // Nombre de la tabla
    protected $fillable = [
        'id',
        'agent_id',
        'user_id',
        'content'
    ];

    /**
     * Relación con el agente (un comentario pertenece a un agente).
     */
    public function agent()
    {
        return $this->belongsTo(Agents::class, 'agent_id', 'id');
    }

    /**
     * Relación con el usuario (un comentario pertenece a un usuario).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Obtener todas las respuestas de un comentario.
     */
    public function replies()
    {
        return $this->hasMany(Reply::class, 'comment_id', 'id');
    }

    /**
     * Obtener todos los likes del comentario.
     */
    public function likes()
    {
        return $this->hasMany(CommentLike::class, 'comment_id', 'id');
    }

    /**
     * Crear un nuevo comentario.
     *
     * @param array $data
     * @return Comment
     */
    public static function createComment(array $data)
    {
        $data['user_id'] = auth()->id();
        return self::create($data);
    }
}
