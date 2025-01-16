<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    // Método para mostrar el formulario de edición
    public function edit()
    {
        $user = User::getUserId(auth()->id()); // Obtiene el usuario autenticado
        return view('profile', compact('user')); // Pasa el usuario a la vista
    }

    // Método para actualizar el perfil
    public function update(Request $request)
    {
        $user = User::getUserId(auth()->id()); // Obtiene el usuario autenticado

        // Validación de los campos
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed', // La contraseña es opcional
        ]);

        // Actualización de los datos del usuario
        $user->username = $validated['username'];

        if ($request->filled('password')) {
            $user->password = bcrypt($validated['password']); // Encriptar la nueva contraseña
        }

        // Guardar cambios en la base de datos
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Perfil actualizado correctamente.');
    }
}
