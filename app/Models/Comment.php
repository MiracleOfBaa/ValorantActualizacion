<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
     * Obtener todos los comentarios de un agente específico.
     *
     * @param string $agentId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getCommentsForAgent($agentId)
    {
        return self::where('agent_id', $agentId)->get();
    }

    /**
     * Obtener todos los comentarios hechos por un usuario específico.
     *
     * @param string $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getCommentsByUser($userId)
    {
        return self::where('user_id', $userId)->get();
    }

    /**
     * Obtener un comentario específico por su ID.
     *
     * @param int $commentId
     * @return Comment|null
     */
    public static function getCommentById($commentId)
    {
        return self::find($commentId);
    }

    /**
     * Crear un nuevo comentario.
     *
     * @param array $data
     * @return Comment
     */
    public static function createComment(array $data)
    {
        return self::create($data);
    }
}
