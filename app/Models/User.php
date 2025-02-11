<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserLikes;

/**
 * 
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $role
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, UserLikes> $likedAgents
 * @property-read int|null $liked_agents_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Agents> $likes
 * @property-read int|null $likes_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUsername($value)
 * @mixin \Eloquent
 */
class User extends Model implements Authenticatable
{
    protected $table = 'users';  // Nombre de la tabla

    protected $fillable = [
        'role',
        'username',
        'password',
        'updated_at',
        'created_at',
        'remember_token',
    ];

    // Para evitar que se muestre el campo 'password' en respuestas JSON
    protected $hidden = [
        'password',
    ];

    // En el modelo User (User.php)
    public function likedAgents()
    {
        return $this->hasMany(UserLikes::class, 'user_id');  // Ajusta 'user_id' según tu clave foránea
    }


    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getAuthIdentifierName()
    {
        return 'username';  // Usar 'username' para la autenticación
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getRememberToken()
    {
        return $this->remember_token;  // Recuerda el token de la sesión si lo tienes configurado
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getAuthPasswordName()
    {
        return 'password';  // Usar 'password' para la autenticación
    }

    public function getRememberTokenName()
    {
        return 'password';  // Nombre del campo de la tabla para el token de la sesión
    }

    public static function getUserId($id)
    {
        return User::find($id);
    }

    // User.php
    public function likes()
    {
        return $this->belongsToMany(Agents::class, 'user_likes', 'user_id', 'agent_id');
    }

    public static function isLiked($agentId)
    {
        $user = $this;
        if($user == null) {
            $user = User::find(auth()->id());
        }
        return $user->likes()->where('agent_id', $agentId)->exists();
    }
}
