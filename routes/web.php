<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ArticleController;
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
Route::get('/', [MainController::class, 'home'])->name('home.page');
Route::get('/about', [MainController::class, 'about'])->name('about.page');
Route::get('/contact', [MainController::class, 'contact'])->name('contact.page');
Route::get('/dermatologists', [MainController::class, 'dermatologists'])->name('dermatologists.page');
Route::get('/booking', [MainController::class, 'booking'])->name('booking.page');

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
     // Disease Routes
    Route::get('/disease/index', [DiseaseController::class, 'index'])->name('disease.index');
    Route::get('/disease/create', [DiseaseController::class, 'create'])->name('disease.create');
    Route::post('/disease/store', [DiseaseController::class, 'store'])->name('disease.store');
    Route::get('/disease/edit/{id}', [DiseaseController::class, 'edit'])->name('disease.edit');
    Route::post('/disease/update/{id}', [DiseaseController::class, 'update'])->name('disease.update');
    Route::get('/disease/delete/{id}', [DiseaseController::class, 'delete'])->name('disease.delete');
    // Review Routes
    Route::get('/review/index', [ReviewController::class, 'index'])->name('review.index');
    Route::get('/review/create', [ReviewController::class, 'create'])->name('review.create');
    Route::post('/review/store', [ReviewController::class, 'store'])->name('review.store');
    Route::delete('/review/destroy/{id}', [ReviewController::class, 'destroy'])->name('review.destroy');
    Route::get('/review/edit/{id}', [ReviewController::class, 'edit'])->name('review.edit');
    Route::put('/review/update/{id}', [ReviewController::class, 'update'])->name('review.update');
    Route::get('/permission/index', [PermissionController::class, 'index'])->name('permission.index');
    Route::get('/permission/create', [PermissionController::class, 'create'])->name('permission.create');
    Route::post('/permission/store', [PermissionController::class, 'store'])->name('permission.store');
    Route::get('/permission/edit/{id}', [PermissionController::class, 'edit'])->name('permission.edit');
    Route::put('/permission/update/{id}', [PermissionController::class, 'update'])->name('permission.update');
    Route::delete('/permission/destroy/{id}', [PermissionController::class, 'destroy'])->name('permission.destroy');
    Route::get('/role/index', [RoleController::class, 'index'])->name('role.index');
    Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
    Route::post('/role/store', [RoleController::class, 'store'])->name('role.store');
    Route::get('/role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
    Route::put('/role/update/{id}', [RoleController::class, 'update'])->name('role.update');
    Route::delete('/role/destroy/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
    
    // Article Routes
    Route::get('/article/index', [ArticleController::class, 'index'])->name('article.index');
    Route::get('/article/create', [ArticleController::class, 'create'])->name('article.create');
    Route::post('/article/store', [ArticleController::class, 'store'])->name('article.store');
    Route::get('/article/edit/{id}', [ArticleController::class, 'edit'])->name('article.edit');
    Route::put('/article/update/{id}', [ArticleController::class, 'update'])->name('article.update');
    Route::delete('/article/destroy/{id}', [ArticleController::class, 'destroy'])->name('article.destroy');

});

 

require __DIR__.'/auth.php';
