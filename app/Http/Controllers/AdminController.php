<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function edit($id)
    {
        // Buscar el usuario por ID
        $user = User::findOrFail($id);

        // Retornar la vista 'admin.edit' pasando el usuario a la vista
        return view('admin.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Filtrar los campos vacíos
        $data = array_filter($request->only('username', 'password', 'role'), function($value) {
            return !is_null($value) && $value !== '';
        });

        // Encriptar el password si está presente en los datos
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        // Actualizar solo los campos no vacíos
        $user->update($data);

        return redirect()->route('admin.users')->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Usuario eliminado correctamente');
    }

}
