<?php

namespace App\Http\Controllers;

use App\Models\Agents;
use App\Models\Comment;
use App\Models\CommentLike;
use Illuminate\Http\JsonResponse;

class AgentController extends Controller
{
    /**
     * Obtener todos los agentes con sus habilidades.
     *
     * @return JsonResponse
     */
    public function index()
    {
        // Llama a la función para obtener los datos
        $agents = Agents::getAgents();
        
        // Retorna los datos como JSON
        return response()->json($agents);
    }
}
