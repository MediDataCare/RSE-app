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


//Private routes

Route::group([
    'prefix' => 'private',
    'middleware' => ['checkAuthBO'],
], function (){
    Route::get('/', [BackOfficeController::class, 'home']);
    Route::get('/exam-type/', [BackOfficeController::class, 'indexExameType'])->name('exam-type-index');
    Route::get('/exam-type/create', [BackOfficeController::class, 'createExamType'])->name('exam-type-create');
});
//Route::middleware(['CheckAuthBO'])->group(function () {
//    Route::get('/private', [BackOfficeController::class, 'home']);
//    Route::get('/private/exam-type/', [BackOfficeController::class, 'indexExamType'])->name('exam-type-index');
//    Route::get('/private/exam-type/create', [BackOfficeController::class, 'createExamType'])->name('exam-type-create');
//});
//Route::get('/private/exam-type/{id}', [BackOfficeController::class, 'showExameType']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

