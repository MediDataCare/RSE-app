<?php

use App\Http\Controllers\BackOfficeController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
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
})->name('homepage');

Route::get('/contact', function () {
    return view('theme.contact');
});

Route::get('/about', function () {
    return view('theme.about');
});

Route::get('/entitie/form', [FrontEndController::class, 'entitiesForm']);
Route::get('/entitie/profile', [FrontEndController::class, 'entitiesProfile']);
Route::delete('/entitie/profile/{id}', [FrontEndController::class, 'removeStudy'])->name('remove-study');
Route::get('/entitie/profile/{id}', [FrontEndController::class, 'showStudy'])->name('show-study');
Route::get('/user/form', [FrontEndController::class, 'usersForm']);
Route::get('/user/profile', [FrontEndController::class, 'userProfile']);


Route::get('/resgiter-entitie', function () {
    return view('auth.entitie');
});

Route::post('/', [FrontEndController::class, 'entitie_store'])->name('register-entitie');

//Private routes

Route::group([
    'prefix' => 'private',
    'middleware' => ['checkAuthBO'],
], function (){
    Route::get('/', [BackOfficeController::class, 'home']);
    Route::get('/exam-type/', [BackOfficeController::class, 'indexExameType'])->name('exam-type-index');
    Route::get('/exam-type/create', [BackOfficeController::class, 'createExamType'])->name('exam-type-create');
    Route::get('/entities', [BackOfficeController::class, 'entities'])->name('entities');
    Route::get('/entities/{id}/aprove', [BackOfficeController::class, 'aproveEntitie'])->name('aproveEntitie');
    Route::get('/entities/{id}/reject', [BackOfficeController::class, 'rejectEntitie'])->name('rejectEntitie');
    Route::get('/entities/{entitiesId}/all-studies', [BackOfficeController::class, 'showAllStudies'])->name('all-studies');
    Route::get('/entities/{entitiesId}/all-studies/{id}/aprove', [BackOfficeController::class, 'aproveStudy'])->name('aprove-study');
    Route::get('/entities/{entitiesId}/all-studies/{id}/reject', [BackOfficeController::class, 'rejectStudy'])->name('reject-study');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

