<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentAbilities extends Model
{
    protected $table = 'agent_abilities';
    protected $fillable = [
        'id',
        'agent_id',
        'ability_key',
        'header',
        'body',
        'video'
    ];


    /**
     * Relación con el modelo Agents.
     */
    public function agent()
    {
        return $this->belongsTo(Agents::class, 'agent_id', 'id');
    }
}
