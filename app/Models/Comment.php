<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Agents;
/**
 * 
 *
 * @property int $id
 * @property string $agent_id
 * @property int $user_id
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Agents $agent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CommentLike> $likes
 * @property-read int|null $likes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Reply> $replies
 * @property-read int|null $replies_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment whereAgentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment whereUserId($value)
 * @mixin \Eloquent
 */
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
