<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
        $user->update($request->only('username', 'email'));
        return redirect()->route('admin.users')->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Usuario eliminado correctamente');
    }

}
