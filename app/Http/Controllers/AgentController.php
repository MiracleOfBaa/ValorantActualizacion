<?php

namespace App\Http\Controllers;

use App\Models\Agents;
use App\Models\Comment;
use App\Models\CommentLike;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    /**
     * Obtener todos los agentes con sus habilidades.
     *
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        // Inicializar la consulta
        $query = Agents::query();

        // Filtrar por nombre si se ha ingresado en la barra de búsqueda
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filtrar por tipo si se ha seleccionado un tipo específico
        if ($request->has('filterBy') && $request->filterBy != '') {
            if ($request->filterBy == 'liked') {

                $query->whereHas('likes');  // Verifica que la relación "likes" esté configurada en el modelo Agent
            } else {
                // Filtrar por tipo (centinela, controlador, etc.)
                $query->where('type', $request->filterBy);
            }
        }

        // Obtener los agentes filtrados
        $agents = $query->get();

        // Pasar los agentes a la vista
        return view('agents', compact('agents'));
    }

    public function show($id)
    {
        // Obtener el agente con el ID especificado
        $agent = Agents::findOrFail($id);

        // Pasar el agente a la vista
        return view('agent', compact('agent'));
    }

}
