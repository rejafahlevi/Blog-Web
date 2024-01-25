<?php

use App\Http\Controllers\BirdyController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard',[BirdyController::class, 'dashboard'] )->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/birds',[BirdyController::class, 'index'] )->middleware(['auth', 'verified'])->name('birdy.index');

Route::post('/birds', [BirdyController::class, 'store'])->middleware(['auth', 'verified'])->name('birdy.store');

Route::get('/birds/{id}', [BirdyController::class, 'edit'])->middleware(['auth', 'verified'])->name('birdy.edit');

Route::put('/birds/{id}', [BirdyController::class, 'update'])->middleware(['auth', 'verified'])->name('birdy.update');

Route::delete('/birds/{id}', [BirdyController::class, 'destroy'])->middleware(['auth', 'verified'])->name('birdy.destroy');


Route::middleware(['auth','role:admin'])->group(function() {

    Route::get('/admin/admin_dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    
    Route::get('/admin/admin_birdy', [AdminController::class, 'AdminBirdy'])->name('admin.birdy');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';

