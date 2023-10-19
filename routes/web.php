<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagemant;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ----------------------------- user controller -------------------------//
Route::controller(UserManagemant::class)->group(function () {
    Route::get('list/users', 'index')->middleware('auth')->name('list/users');
    Route::get('list/user/show/{id}', 'userView')->middleware('auth');
    Route::get('list/user/{id}/edit', 'editUser')->middleware('auth');
    Route::post('/user/update/{id}', 'userUpdate')->name('user.update');
    Route::get('/user/delete/{id}', 'userDelete')->name('user/delete');
});

Route::resource('/home/task', TaskController::class)->middleware('auth');
Route::post('/home/task/{id}', [TaskController::class, 'destroy'])->name('task/delete'); // delete record task
Route::delete('/selected-employee', [TaskController::class, 'deleteAll'])->name('task.delete');




