<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentLike extends Model
{
    protected $table = 'comment_likes';  // Nombre de la tabla
    protected $fillable = [
        'user_id',
        'comment_id'
    ];

    /**
     * Relación con el usuario (un like pertenece a un usuario).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Relación con el comentario (un like pertenece a un comentario).
     */
    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id', 'id');
    }

    /**
     * Obtener todos los "likes" de un comentario específico.
     *
     * @param int $commentId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getLikesForComment($commentId)
    {
        return self::where('comment_id', $commentId)->get();
    }

    /**
     * Obtener todos los "likes" de un usuario específico.
     *
     * @param string $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getLikesByUser($userId)
    {
        return self::where('user_id', $userId)->get();
    }

    /**
     * Verificar si un usuario ya ha dado "like" a un comentario.
     *
     * @param string $userId
     * @param int $commentId
     * @return bool
     */
    public static function hasLikedComment($userId, $commentId)
    {
        return self::where('user_id', $userId)
                   ->where('comment_id', $commentId)
                   ->exists();
    }

    /**
     * Crear un nuevo "like".
     *
     * @param array $data
     * @return CommentLike
     */
    public static function createLike(array $data)
    {
        return self::create($data);
    }
}
