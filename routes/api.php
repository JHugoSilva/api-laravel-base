<?php

use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(StudentController::class)->group(function(){
    Route::get('students', 'index');
    Route::post('students', 'store');
    Route::get('students/{id}','show');
    Route::put('students/{id}', 'update');
    Route::delete('students/{id}', 'destroy');
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});





