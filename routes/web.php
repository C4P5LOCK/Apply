<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;
use App\Models\Application;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    $application = Application::where('user_id', auth()->id())->first();

    return view('dashboard', compact('application'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/application/create', [ApplicationController::class, 'create'])->name('application.create');

    Route::post('/application/store', [ApplicationController::class, 'store'])->name('application.store');
Route::get('/application/preview/{application}', [ApplicationController::class, 'preview'])->name('application.preview');
Route::post('/application/submit/{application}', [ApplicationController::class, 'submit'])->name('application.submit');
});

require __DIR__.'/auth.php';
