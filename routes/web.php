<?php

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

Route::get('/login', function () {
    return redirect(route('login'));
  });

Auth::routes([
    'register' => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// PREPOST - TEST
Route::get('/pre-posttest', [App\Http\Controllers\PrepostTestController::class, 'index'])->name('prepost.index');
Route::post('/pre-posttest/store', [App\Http\Controllers\PrepostTestController::class, 'store'])->name('prepost.store');
Route::get('/pre-posttest-result', [App\Http\Controllers\PrepostTestController::class, 'result'])->name('prepost.result');

// POST TEST
Route::get('/post-test', [App\Http\Controllers\PrepostTestController::class, 'index'])->name('posttest.index');
Route::post('/post-test/store', [App\Http\Controllers\PrepostTestController::class, 'store'])->name('posttest.store');
Route::get('/post-test-result', [App\Http\Controllers\PrepostTestController::class, 'result'])->name('posttest.result');

// EVALUASI
Route::get('/evaluasi', [App\Http\Controllers\EvaluasiController::class, 'index'])->name('evaluasi.index');
Route::post('/evaluasi/store', [App\Http\Controllers\EvaluasiController::class, 'store'])->name('evaluasi.store');

// REPORT
Route::get('/report', [App\Http\Controllers\ReportController::class, 'index'])->name('report.index');