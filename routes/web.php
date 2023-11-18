<?php

use App\Http\Controllers\FeedbackController;
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

Route::get('/', [FeedbackController::class, 'index']);

require __DIR__.'/auth.php';

Route::group(['middleware' => ['auth']], fn() => [
    Route::group(['prefix' => 'feedback'], fn() => [
        Route::get('', [FeedbackController::class, 'create']),
        Route::post('', [FeedbackController::class, 'store'])->name('feedback.store'),
    ]),
]);
