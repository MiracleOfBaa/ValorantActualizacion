<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController; // Asegúrate de importar el ProfileController
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware; // Asegúrate de importar el middleware

// Rutas públicas
Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::get('/about', function () {
    return view('about');
});

Route::get('/info', function () {
    return view('info');
});

Route::get('/news', function () {
    return view('news');
});

Route::get('agents', [AgentController::class, 'index'])->name('agents.index');
Route::get('agents/{id}', [AgentController::class, 'show'])->name('agents.show');

Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/agentform', function () {
    return view('agentform');
});

// Rutas protegidas
Route::middleware(['web'])->group(function () {
    Route::get('/profile', function () {
        return view('profile');
    });

});


// Rutas de autenticación
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// Ruta para guardar el agente creado
Route::post('/agents', [AgentController::class, 'store'])->name('agents.store');

Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');  // Ruta GET para mostrar el perfil
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Ruta POST para actualizar
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Ruta para dar/quitado like
    Route::post('/agents/{id}/like', [AgentController::class, 'like'])->name('agents.like');

    // Rutas para los comentarios
    Route::post('/agents/{agent}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/comments/{comment}/like', [CommentController::class, 'like'])->name('comments.like');
    Route::post('/comments/{comment}/reply', [CommentController::class, 'reply'])->name('comments.reply');

});

Route::middleware(['auth', 'admin'])->group(function () {
    // Ruta para mostrar el formulario de edición de un agente
    Route::get('/agents/{agent}/edit', [AgentController::class, 'edit'])->name('agents.edit');

    // Ruta para actualizar los datos del agente
    Route::put('/agents/{agent}', [AgentController::class, 'update'])->name('agents.update');

    // Ruta para eliminar un agente
    Route::get('/agents.create', [AgentController::class, 'create'])->name('agents.create');
    Route::delete('/agents/{agent}', [AgentController::class, 'destroy'])->name('agents.destroy');
    Route::get('agents/{id}/edit', [AgentController::class, 'edit'])->name('agents.edit');
});


// Rutas para administración (solo accesibles por administradores)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users');
    Route::get('/admin/users/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/users/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/users/{id}', [AdminController::class, 'destroy'])->name('admin.delete');
});

