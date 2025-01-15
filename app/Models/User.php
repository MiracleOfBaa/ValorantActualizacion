<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{
    protected $table = 'user';  // Nombre de la tabla

    protected $fillable = [
        'id',
        'role',
        'username',
        'password',
        'created_at',
    ];

    // Para evitar que se muestre el campo 'password' en respuestas JSON
    protected $hidden = [
        'password',
    ];

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
}
