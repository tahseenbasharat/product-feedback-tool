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

Route::get('/', [FeedbackController::class, 'index'])->name('feedback.index');
Route::get('/feedback/{id}', [FeedbackController::class, 'show'])->name('feedback.show');

require __DIR__.'/auth.php';

Route::group(['middleware' => ['auth']], fn() => [
    Route::group(['prefix' => 'feedback'], fn() => [
        Route::get('', [FeedbackController::class, 'create'])->name('feedback.store'),
        Route::post('', [FeedbackController::class, 'store']),
        Route::post('vote', [FeedbackController::class, 'vote'])->name('feedback.storeVote'),
        Route::post('comment', [FeedbackController::class, 'comment'])->name('feedback.storeComment'),
    ]),
]);
