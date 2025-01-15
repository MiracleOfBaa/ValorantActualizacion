<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLike extends Model
{
    protected $table = 'user_likes';  // Nombre de la tabla

    protected $fillable = [
        'user_id',
        'agent_id',
        'created_at',
    ];

    /**
     * Relación con el modelo User (usuario).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Relación con el modelo Agent (agente).
     */
    public function agent()
    {
        return $this->belongsTo(Agents::class, 'agent_id', 'id');
    }

    /**
     * Obtener todos los "likes" dados por un usuario.
     *
     * @param string $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getUserLikes($userId)
    {
        return self::where('user_id', $userId)->get();
    }

    /**
     * Obtener todos los usuarios que han dado "like" a un agente.
     *
     * @param string $agentId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getAgentLikes($agentId)
    {
        return self::where('agent_id', $agentId)->get();
    }

    /**
     * Verificar si un usuario ha dado "like" a un agente específico.
     *
     * @param string $userId
     * @param string $agentId
     * @return bool
     */
    public static function hasUserLikedAgent($userId, $agentId)
    {
        return self::where('user_id', $userId)->where('agent_id', $agentId)->exists();
    }

    /**
     * Crear un "like" para un usuario en un agente específico.
     *
     * @param string $userId
     * @param string $agentId
     * @return UserLike
     */
    public static function createLike($userId, $agentId)
    {
        return self::create([
            'user_id' => $userId,
            'agent_id' => $agentId,
        ]);
    }
}
