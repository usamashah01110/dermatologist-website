<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\DermatologistController;
use App\Http\Controllers\SkincareController;
use App\Http\Controllers\MainController;
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
Route::get('/', [MainController::class, 'home'])->name('home.page');
Route::get('/about', [MainController::class, 'about'])->name('about.page');
Route::get('/contact', [MainController::class, 'contact'])->name('contact.page');
Route::get('/dermatologists', [MainController::class, 'dermatologists'])->name('dermatologists.page');
Route::get('/booking', [MainController::class, 'booking'])->name('booking.page');

Route::get('/register/dermatologist', [DermatologistController::class, 'index'])->name('register.dermatologist');
Route::get('/skincare', [SkincareController::class, 'index'])->name('skincare.page');

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

});

require __DIR__.'/auth.php';
