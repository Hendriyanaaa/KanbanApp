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
Route::get('/tasks/index', [TaskController::class, 'index'])->name('tasks.index');
Route::get('welcome', function (){
    return view('welcome');
});
Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
Route::post('/tasks/store', [TaskController::class, 'store'])->name('tasks.store');
Route::put('/tasks/{id}/update', [TaskController::class, 'update'])->name('tasks.update');
Route::get('/tasks/{id}/delete', [TaskController::class, 'delete'])->name('tasks.delete');
Route::delete('/tasks/{id}/destroy', [TaskController::class, 'destroy'])->name('tasks.destroy');