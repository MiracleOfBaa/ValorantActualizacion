<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage; // Importar el modelo
use Mail;
use App\Mail\ContactMessageMail;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        // Validación
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|max:1000',
        ]);

        // Guardar en la base de datos
        $contactMessage = ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'message' => $validated['message'],
        ]);

        // Enviar correo
        Mail::to('unakpa242004@gmail.com')->send(new ContactMessageMail($contactMessage));

        // Redirigir con mensaje de éxito
        return redirect()->route('contact.create')->with('success', 'Mensaje enviado correctamente');
    }
}
