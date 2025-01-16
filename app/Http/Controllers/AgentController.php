<?php

namespace App\Http\Controllers;

use App\Models\Agents;
use App\Models\Comment;
use App\Models\CommentLike;
use App\Models\User;
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
            // Filtrar solo los agentes que el usuario autenticado ha dado "like"
            $query->whereHas('likes', function ($query) {
                $query->where('user_id', auth()->id()); // Filtrar por el ID del usuario autenticado
            })
            ->withCount('likes') // Contar los "likes"
            ->orderByDesc('likes_count'); // Ordenar por cantidad de "likes" de forma descendente
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

    public function like($id)
    {
        $user = User::find(auth()->id()); // Obtener el usuario autenticado
        $agent = Agents::findOrFail($id);  // Obtener el agente por su ID

        // Verificar si el usuario ya ha dado like
        if ($user->likes()->where('agent_id', $agent->id)->exists()) {
            // Si ya le dio like, quitar el like
            $user->likes()->detach($agent->id);
        } else {
            // Si no le ha dado like, agregar el like
            $user->likes()->attach($agent->id);
        }

        // Redirigir de vuelta a la página anterior
        return back();
    }




    public function show($id)
    {
        // Obtener el agente con el ID especificado
        $agent = Agents::findOrFail($id);

        // Pasar el agente a la vista
        return view('agent', compact('agent'));
    }

}
