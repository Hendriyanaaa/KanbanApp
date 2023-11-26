<?php

use App\Http\Controllers\AboutusController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactusController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class,'index']);
Route::get('/news', [NewsController::class,'index']);
Route::get('/category', [CategoryController::class,'index']);
Route::get('/aboutus', [AboutusController::class,'aboutus']);
Route::get('/contactus', [ContactusController::class,'contactus']);
Route::get('/address', [AddressController::class,'address']);
Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/tasks/', [TaskController::class, 'index'])->name('tasks.index');
Route::get('welcome', function (){
    return view('welcome');
});
Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');