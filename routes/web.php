<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;


Route::get('/', function () {
  return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/agent', function () {
    return view('agent');
});

Route::get('/agentedit', function () {
    return view('agentedit');
});

Route::get('/agentform', function () {
    return view('agentform');
});

Route::get('/agents', function () {
    return view('agents');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/info', function () {
    return view('info');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/news', function () {
    return view('news');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/result', function () {
    return view('result');
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Tests
use App\Http\Controllers\AgentController;

Route::get('/agents_test', [AgentController::class, 'index']);
