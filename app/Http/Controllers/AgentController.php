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

    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Obtener el agente de la base de datos
        $agent = Agents::findOrFail($id);

        // Actualizar el nombre del agente
        $agent->name = $validated['name'];

        // Si se ha subido una nueva foto, actualizarla
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('public/photos'); // Guardar la nueva foto
            $agent->photo = basename($path); // Guardar solo el nombre del archivo
        }

        // Guardar los cambios
        $agent->save();

        // Redirigir al agente editado
        return redirect()->route('agents.show', $agent->id)->with('success', 'Agent updated successfully');
    }


    // Manejar el envío del formulario
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'type' => 'required|string',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'nullable|image',
            'wallpaper' => 'nullable|image',
            'q_header' => 'nullable|string',
            'q_body' => 'nullable|string',
            'q_video' => 'nullable|file|mimes:mp4,avi,mkv',
            'e_header' => 'nullable|string',
            'e_body' => 'nullable|string',
            'e_video' => 'nullable|file|mimes:mp4,avi,mkv',
            'c_header' => 'nullable|string',
            'c_body' => 'nullable|string',
            'c_video' => 'nullable|file|mimes:mp4,avi,mkv',
            'x_header' => 'nullable|string',
            'x_body' => 'nullable|string',
            'x_video' => 'nullable|file|mimes:mp4,avi,mkv',
        ]);

        // Creación del nuevo agente
        $agent = new Agents;
        $agent->type = $request->type;
        $agent->name = $request->name;
        $agent->description = $request->description;

        // Subir imagen de foto
        if ($request->hasFile('photo')) {
            // Guardar en una ruta personalizada fuera del directorio public
            $path = $request->file('photo')->storeAs('agents/photos', $request->file('photo')->getClientOriginalName(), 'public');
            $agent->photo = $path; // Guardar la ruta completa
        }

        // Subir wallpaper
        if ($request->hasFile('wallpaper')) {
            // Guardar en una ruta personalizada fuera del directorio public
            $path = $request->file('wallpaper')->storeAs('agents/wallpapers', $request->file('wallpaper')->getClientOriginalName(), 'public');
            $agent->wallpaper = $path; // Guardar la ruta completa
        }

        // Guardar el agente
        $agent->save();

        // Almacenar las habilidades (asumiendo que estas habilidades vienen del request)
        $abilities = [
            [
                'ability_key' => 'q',
                'header' => $request->q_header,
                'body' => $request->q_body,
                'video' => $request->hasFile('q_video') ? $request->file('q_video')->storeAs('agents/videos', $request->file('q_video')->getClientOriginalName(), 'public') : null,
            ],
            [
                'ability_key' => 'e',
                'header' => $request->e_header,
                'body' => $request->e_body,
                'video' => $request->hasFile('e_video') ? $request->file('e_video')->storeAs('agents/videos', $request->file('e_video')->getClientOriginalName(), 'public') : null,
            ],
            [
                'ability_key' => 'c',
                'header' => $request->c_header,
                'body' => $request->c_body,
                'video' => $request->hasFile('c_video') ? $request->file('c_video')->storeAs('agents/videos', $request->file('c_video')->getClientOriginalName(), 'public') : null,
            ],
            [
                'ability_key' => 'x',
                'header' => $request->x_header,
                'body' => $request->x_body,
                'video' => $request->hasFile('x_video') ? $request->file('x_video')->storeAs('agents/videos', $request->file('x_video')->getClientOriginalName(), 'public') : null,
            ],
        ];

        // Guardar las habilidades del agente
        foreach ($abilities as $ability) {
            $agent->abilities()->create($ability);
        }

        // Redirigir con un mensaje de éxito
        return redirect()->route('agents.create')->with('success', 'Agent created successfully!');
    }

    public function destroy($id)
    {
        // Buscar el agente por su ID
        $agent = Agents::findOrFail($id);

        // Eliminar el agente
        $agent->delete();

        // Redirigir o devolver una respuesta
        return redirect()->route('agents.index')->with('success', 'Agente eliminado con éxito');
    }


    public function edit($id)
    {
        // Obtener el agente por su ID
        $agent = Agents::findOrFail($id); // Busca el agente en la base de datos o lanza un error si no lo encuentra

        // Pasamos el agente a la vista de edición
        return view('edit', compact('agent')); // 'edit' es la vista que mostrarás para editar
    }

    public function create()
    {
        $roles = ['centinela', 'controlador', 'soporte', 'sanador', 'atacante'];
        return view('agents.create', compact('roles'));
    }

}

