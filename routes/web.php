<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController; // Asegúrate de importar el ProfileController
use App\Http\Controllers\CommentController;

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
Route::get('agents/{id}/edit', [AgentController::class, 'edit'])->name('agents.edit');

Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/agentform', function () {
    return view('agentform');
});

// Rutas protegidas
Route::middleware(['web'])->group(function () {
    // Route::get('/profile', function () {
    //     return view('profile');
    // });
});
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');  // Ruta GET para mostrar el perfil
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Ruta POST para actualizar
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rutas de autenticación
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');


// Rutas para los comentarios
Route::post('/agents/{agent}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::post('/comments/{comment}/like', [CommentController::class, 'like'])->name('comments.like');
Route::post('/comments/{comment}/reply', [CommentController::class, 'reply'])->name('comments.reply');


// Ruta para dar/quitado like
Route::post('/agents/{id}/like', [AgentController::class, 'like'])->name('agents.like');
