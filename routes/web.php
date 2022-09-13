<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('tasks.index');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::resource('tasks', TaskController::class)->parameters(['tasks' => 'id'])->middleware('auth');

Route::resource('projects', ProjectController::class)->parameters(['projects' => 'id'])->middleware('auth');
