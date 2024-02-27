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
Route::group(['middleware' => ['auth']], function () {
    Route::get('/training/{flag}', [App\Http\Controllers\PrepostTestController::class, 'index'])->name('training.index');
    Route::post('/training/{flag}/store', [App\Http\Controllers\PrepostTestController::class, 'store'])->name('training.store');

    // EVALUASI
    Route::get('/evaluasi/{flag}', [App\Http\Controllers\EvaluasiController::class, 'index'])->name('evaluasi.index');
    Route::post('/evaluasi/{flag}/store', [App\Http\Controllers\EvaluasiController::class, 'store'])->name('evaluasi.store');

    // REPORT
    Route::match(['get', 'post'], '/report', [App\Http\Controllers\ReportController::class, 'index'])->name('report.index');
});