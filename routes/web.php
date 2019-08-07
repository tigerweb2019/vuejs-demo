<?php

use App\Exam;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/room/{slug}', function ($slug) {
    $exam = Exam::where('slug', $slug)->first();

    return view('room', [
        'exam' => $exam
    ]);
});
