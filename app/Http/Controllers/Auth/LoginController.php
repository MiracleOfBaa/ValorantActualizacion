<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;  // Asegúrate de tener el modelo de usuario importado
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Importa el Hash
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Validar las credenciales
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Buscar al usuario por el nombre de usuario
        $user = User::where('username', $credentials['username'])->first();

        // Verificar si el usuario existe y si la contraseña es correcta
        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);
            $request->session()->regenerate();

            // Prueba si el usuario está autenticado
            if (Auth::check()) {
                print(Auth::user());
                return redirect()->intended('/')->with('success', '¡Inicio de sesión exitoso!');
            } else {
                return redirect()->back()->with('error', 'Algo salió mal al autenticar.');
            }
        }

        // Si las credenciales son incorrectas, muestra un mensaje de error
        throw ValidationException::withMessages([
            'username' => ['Las credenciales proporcionadas no son correctas.'],
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
