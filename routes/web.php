<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;

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

Route::post('showQuiz', [QuizController::class, 'showQuiz'])->name('showQuiz');

Route::post('nextQuestion', [QuizController::class, 'nextQuestion'])->name('nextQuestion');

Route::post('skipQuestion', [QuizController::class, 'skipQuestion'])->name('skipQuestion');

Route::get('getResult', [QuizController::class, 'getResult'])->name('getResult');

