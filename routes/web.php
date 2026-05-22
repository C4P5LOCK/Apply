<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;
use App\Models\Application;
use App\Http\Controllers\AdminController;

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

    Route::get('/application/edit/{application}', [ApplicationController::class, 'edit'])->name('application.edit');

    Route::put('/application/update/{application}', [ApplicationController::class, 'update'])->name('application.update');
});

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/dashboard',[AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/admin/application/{application}',[AdminController::class, 'show'])->name('admin.application.show');

    Route::post('/admin/application/{application}/status',[AdminController::class, 'updateStatus'])->name('admin.application.status');
});

require __DIR__.'/auth.php';
