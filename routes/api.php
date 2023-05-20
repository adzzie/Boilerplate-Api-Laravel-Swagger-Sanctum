<?php

use App\Http\Controllers\API\AuthAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/auth/register', [AuthAPIController::class,'register',])->name('auth.register');
Route::post('/auth/login', [AuthAPIController::class,'login',])->name('auth.login');

Route::group(['middleware'=>['auth:sanctum']], function (){

    Route::post('/auth/logout', [AuthAPIController::class,'logout',])->name('auth.logout');
    Route::get('/auth/user', [AuthAPIController::class,'getUser',])->name('auth.user');


    Route::resource('companies', App\Http\Controllers\API\CompanyAPIController::class)
    ->except(['create', 'edit']);
});

