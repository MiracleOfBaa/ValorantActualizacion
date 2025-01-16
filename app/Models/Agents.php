<?php

namespace App\Models;

use App\Models\AgentAbilities;
use App\Models\UserLikes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Agents extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'type',
        'name',
        'photo',
        'wallpaper',
        'description',
    ];

    // Aquí puedes agregar un método para generar UUIDs cuando se cree un nuevo modelo
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = (string) Str::uuid();
            }
        });
    }
    /**
     * Relación con las habilidades del agente.
     */
    public function abilities()
    {
        return $this->hasMany(AgentAbilities::class, 'agent_id', 'id');
    }

    // Agent.php
    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'user_agent', 'agent_id', 'user_id');
    }


    // En el modelo Agent (Agent.php)
    public function likes()
    {
        return $this->hasMany(UserLikes::class, 'agent_id');  // Ajusta 'agent_id' según tu clave foránea
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'agent_id', 'id');
    }

    // Agent.php
    public function isLikedByUser($id)
    {
        return $this->likes()->where('user_id', $id)->exists();
    }


    public static function getTypeAgents($type)
    {
        $agents = self::with('abilities')->where('type', $type)->get();
        return $agents;
    }

    public static function getOrderByLikes()
    {
        $agents = self::with('abilities')->orderBy('likes', 'desc')->get();
        return $agents;
    }

    public static function getAgents()
    {
        $agents = self::with('abilities')->get();
        return $agents;
    }
}
