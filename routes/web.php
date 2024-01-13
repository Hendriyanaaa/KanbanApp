<?php

use App\Http\Controllers\AboutusController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactusController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AuthController;
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
Route::prefix('tasks')
    ->name('tasks.')
    ->middleware('auth')
    ->controller(TaskController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create'); 
        Route::post('/', 'store')->name('store');
        Route::get('{id}/show', 'show')->name('show');
        Route::put('/{id}', 'update')->name('update'); 
        Route::get('{id}/delete', 'delete')->name('delete');
        Route::delete('/{id}', 'destroy')->name('destroy');
        Route::get('{id}/edit', 'edit')->name('edit');
        Route::get('progress', 'progress')->name('progress');
        Route::patch('{id}/move', 'move')->name('move');
        Route::get('complete', 'complete')->name('complete');
    });
// Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
// Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
// Route::post('/tasks/store', [TaskController::class, 'store'])->name('tasks.store');
// Route::put('/tasks/{id}/update', [TaskController::class, 'update'])->name('tasks.update');
// Route::get('/tasks/{id}/delete', [TaskController::class, 'delete'])->name('tasks.delete');
// Route::get('/tasks/progress', [TaskController::class, 'progress'])->name('tasks.progress');
// Route::delete('/tasks/{id}/destroy', [TaskController::class, 'destroy'])->name('tasks.destroy');
// Route::patch('/tasks/{id}/move', [TaskController::class, 'move'])->name('tasks.move');
// Route::get('/tasks/complete', [TaskController::class, 'complete'])->name('tasks.complete');
Route::name('auth.')
    ->controller(AuthController::class)
    ->group(function () {
        Route::middleware('guest')->group(function () 
        {
        Route::get('signup', 'signupForm')->name('signupForm');
        Route::post('signup', 'signup')->name('signup');
        Route::get('login', 'loginForm')->name('loginForm');
        Route::post('login', 'login')->name('login');
        });
        Route::middleware('auth')->group(function () {
        Route::post('logout', 'logout')->name('logout'); 
    });
    });