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

Auth::routes([
    'register' => false
]);

Route::get('/otp', [\App\Http\Controllers\Auth\RegisterController::class, 'otp'])->name('otp');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['prefix' => 'member', 'as' =>'member.', 'middleware' =>['auth', 'checkRole:admin,member']], function (){
    Route::get('/', [\App\Http\Controllers\UserController::class, 'index'])->name('index');
});
Route::group(['prefix' => 'placement', 'as' =>'placement.', 'middleware' =>['auth', 'checkRole:admin,member']], function (){
    Route::get('/{rack_no}', [\App\Http\Controllers\PlacementController::class, 'index'])->name('index');
    Route::post('/{rack_no}', [\App\Http\Controllers\PlacementController::class, 'store'])->name('store');
});
Route::get('/mapping-placement', [App\Http\Controllers\PlacementController::class, 'mapping_placement'])->name('mapping');


// Report Group
Route::get('/stock-balance-list', [App\Http\Controllers\ReportController::class, 'stock_balance'])->name('stockbalance');
Route::get('/detail-balance-list', [App\Http\Controllers\ReportController::class, 'detail_balance'])->name('detailbalance');
Route::get('/mapping-cold-storage', [App\Http\Controllers\ReportController::class, 'mapping_cs'])->name('mappingcs');
Route::post('/detail-mapping-cold-storage', [App\Http\Controllers\ReportController::class, 'detail_mapping_cs'])->name('mappingcs.detail');


