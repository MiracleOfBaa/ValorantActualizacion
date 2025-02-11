<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Agents;

/**
 * 
 *
 * @property int $id
 * @property string $agent_id
 * @property string $ability_key
 * @property string $header
 * @property string $body
 * @property string|null $video
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Agents $agent
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AgentAbilities newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AgentAbilities newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AgentAbilities query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AgentAbilities whereAbilityKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AgentAbilities whereAgentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AgentAbilities whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AgentAbilities whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AgentAbilities whereHeader($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AgentAbilities whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AgentAbilities whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AgentAbilities whereVideo($value)
 * @mixin \Eloquent
 */
class AgentAbilities extends Model
{
    protected $table = 'agent_abilities'; // Nombre de la tabla
    protected $fillable = [
        'id',
        'agent_id',
        'ability_key',
        'header',
        'body',
        'video'
    ];

    /**
     * Relación inversa con el modelo Agents.
     */
    public function agent()
    {
        return $this->belongsTo(Agents::class, 'agent_id', 'id');
    }

    public static function getAbilities($agent_id)
    {
        return self::where('agent_id', $agent_id)->get();
    }
}