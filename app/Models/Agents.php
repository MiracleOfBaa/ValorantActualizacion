<?php

namespace App\Models;

use App\Models\AgentAbilities;
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

    public function comments()
    {
        return $this->hasMany(Comment::class, 'agent_id', 'id');
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
