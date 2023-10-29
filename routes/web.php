<?php

use App\Http\Controllers\BackOfficeController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\HomeController;
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
    return view('index');
});

Route::get('/contact', function () {
    return view('theme.contact');
});

Route::get('/about', function () {
    return view('theme.about');
});

Route::get('/entitie/form', [FrontEndController::class, 'entitiesForm']);
Route::get('/entitie/profile', [FrontEndController::class, 'entitiesProfile']);
Route::get('/user/form', [FrontEndController::class, 'usersForm']);
Route::get('/user/profile', [FrontEndController::class, 'userProfile']);
Route::get('/private/exam-type/create', [BackOfficeController::class, 'createExamType']);
Route::get('/private/exam-type/{id}', [BackOfficeController::class, 'showExameType']);
Route::get('/private/exam-type/', [BackOfficeController::class, 'indexExameType']);
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

