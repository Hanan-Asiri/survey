<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveyController;
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

//Route::get('/', function () {
  //  return view('welcome');
//});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [App\Http\Controllers\SurveyController::class, 'GetSurvey'])->name("getsurvy");
Route::get('/reg', [App\Http\Controllers\SurveyController::class, 'GetSurvey'])->name("getsurvy");
Route::get('/createsurvey', [App\Http\Controllers\SurveyController::class, 'GetSurvey'])->name("getsurvy");
Route::get('/createnewsurvey', [App\Http\Controllers\SurveyController::class, 'create'])->name("createnewsurvey");
Route::get('/getquestionspage', [App\Http\Controllers\SurveyController::class, 'getquestionspage'])->name("my-getquestionspage");
Route::get('/createnewanswer', [App\Http\Controllers\SurveyController::class, 'create_newanswer'])->name("my-createnewanswer");
Route::get('/getmyAccount', [App\Http\Controllers\SurveyController::class, 'getmyAccount'])->name("my-getmyAccount");
Route::get('/updateuser', [App\Http\Controllers\SurveyController::class, 'updateuser'])->name("my-updateuser");
Route::get('/getmyanswre', [App\Http\Controllers\SurveyController::class, 'GetmyAnswre'])->name("my-getmyanswre");
Route::get('/admin', [App\Http\Controllers\SurveyController::class, 'GetAdmin'])->name("my-GetAdmin");

Route::get('/getquestions', [App\Http\Controllers\SurveyController::class, 'getquestionadmin'])->name("my-getquestionadmin");
Route::get('/createquestion', [App\Http\Controllers\SurveyController::class, 'create_question'])->name("my-createquestion");
Route::get('/updatequestion', [App\Http\Controllers\SurveyController::class, 'update_question'])->name("my-updatequestion");
Route::get('/deletequestion', [App\Http\Controllers\SurveyController::class, 'delete_question'])->name("my-deletequestion");
Route::get('/getanswre', [App\Http\Controllers\SurveyController::class, 'getanswre'])->name("my-getanswre");

Route::get('/createoptions', [App\Http\Controllers\SurveyController::class, 'createoptions'])->name("my-createoptions");
Route::get('/createnewoption', [App\Http\Controllers\SurveyController::class, 'create_newoption'])->name("my-createnewoption");
Route::get('/getoptions', [App\Http\Controllers\SurveyController::class, 'getoptions'])->name("my-getoptions");



