<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveyController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//
Route::get('/GetAllQuestions', [App\Http\Controllers\SurveyController::class, 'GetAllQuestions'])->name("GetAllQuestions");
Route::get('/GetQuestionOptions/{id}', [App\Http\Controllers\SurveyController::class, 'GetQuestionOptions'])->name("GetQuestionOptions");
Route::get('/GetQuestionResponse/{id}', [App\Http\Controllers\SurveyController::class, 'GetQuestionResponse'])->name("GetQuestionResponse");
