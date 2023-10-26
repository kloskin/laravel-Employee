<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeControlller;

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
Route::get('/', [EmployeeControlller::class,'index'])->name('employees.index');
Route::get('/employees/user/{id}', [EmployeeControlller::class,'user'])->name('employees.user');
Route::resource('employees', EmployeeControlller::class);


require __DIR__.'/auth.php';
