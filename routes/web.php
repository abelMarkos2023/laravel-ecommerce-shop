<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\ProfileController;
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
    return view('dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('categories/trash', [CategoryController::class, 'trash'])
    ->middleware(['auth'])
    ->name('categories.trash');

    Route::put('categories/{category}/restore', [CategoryController::class, 'restoreCategory'])
    ->middleware(['auth'])
    ->name('categories.restore');

    Route::delete('categories/{category}/force-delete', [CategoryController::class, 'forceDeleteCategory'])
    ->middleware(['auth'])
    ->name('categories.force-delete');

Route::resource('categories', CategoryController::class)->middleware(['auth']);
Route::resource('products', ProductController::class)->middleware(['auth']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
