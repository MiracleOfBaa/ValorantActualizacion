<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        // Validación de los datos del formulario
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|min:5|unique:user,username',
            'password' => 'required|string|min:8|confirmed', // Confirmación de contraseña
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Crear un nuevo usuario
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password), // Aquí el setter se encarga de hacer el hash
            'role' => 'user', // Este valor lo puedes modificar dependiendo de los roles
        ]);

        Auth::login($user);

        // Redirigir al login o a otra página después de la creación
        return redirect()->route('login')->with('success', 'Usuario registrado exitosamente.');
    }
}
