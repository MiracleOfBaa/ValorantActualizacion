<?php

namespace App\Models;

use App\Models\AgentAbilities;
use Illuminate\Database\Eloquent\Model;

class Agents extends Model
{
    protected $table = 'agents'; // Nombre de la tabla
    protected $fillable = [
        'id',
        'type',
        'name',
        'photo',
        'wallpaper',
        'description'
    ];

    /**
     * Relación con las habilidades del agente.
     */
    public function abilities()
    {
        return $this->hasMany(AgentAbilities::class, 'agent_id', 'id');
    }
    
    

    /**
     * Recuperar todos los agentes con sus habilidades.
     *
     * @return array
     */
    public static function getAgents()
    {
        $agent = Agents::find('123e4567-e89b-12d3-a456-426614174000');
        $abilities = $agent->abilities;
        dd($abilities);  // Verifica si las habilidades están presentes

        // Recuperar 
        // Obtener todos los agentes con sus habilidades
        return self::with('abilities')->get();
    }
}
