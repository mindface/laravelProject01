<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskApiController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('welcome');
});

Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

  Route::get('/tasks/create', [TaskController::class, 'create'])->name('task.create');
  Route::get('/tasks', [TaskController::class, 'index'])->name('task.index');
  Route::post('/tasks', [TaskController::class, 'store'])->name('task.store');
  Route::put('/tasks/{id}', [TaskController::class, 'update']);

  Route::get('/tasksapi', [TaskApiController::class, 'index'])->name('taskapi.index');
  Route::post('/tasksapi', [TaskApiController::class, 'store'])->name('taskapi.store');
  Route::put('/tasksapi/{id}', [TaskApiController::class, 'update'])->name('taskapi.update');
  Route::delete('/tasksapi/{id}', [TaskApiController::class, 'destroy'])->name('taskapi.destroy');
});

require __DIR__.'/auth.php';
