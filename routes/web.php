<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes([
    'reset' => false,
    'verify' => false,
    'register' => false,
]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    // Route::view('about', 'about')->name('about');
    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('profile', [\App\Http\Controllers\UserController::class, 'profile'])->name('users.profile');
    Route::put('profile', [\App\Http\Controllers\UserController::class, 'updateProfile'])->name('users.profile.update');
    Route::resource('contracts', App\Http\Controllers\ContractController::class);
    // Stream contract attachments through the app so files are accessible even if NAS HTTP is not public
    Route::get('contracts/file/{contract}', [App\Http\Controllers\ContractFileController::class, 'show'])
        ->name('contracts.file');
    // Attachment streaming
    Route::get('attachments/file/{attachment}', [App\Http\Controllers\AttachmentFileController::class, 'show'])
        ->name('attachments.file');
});
