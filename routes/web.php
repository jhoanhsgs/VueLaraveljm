<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('dashboard')->middleware('auth')->group(function(){
    Route::get('contacts',[ContactController::class,'index'])->name('contacts.index');
    Route::get('contacts/create',[ContactController::class,'create'])->name('contacts.create');
    Route::post('contacts',[ContactController::class,'store'])->name('contacts.store');
    Route::get('contacts/{contact}/edit',[ContactController::class,'edit'])->name('contacts.edit');
    Route::post('contacts/{contact}',[ContactController::class,'update'])->name('contacts.update');
    Route::delete('contacts/{contact}',[ContactController::class,'destroy'])->name('contacts.destroy');


});



require __DIR__.'/auth.php';
