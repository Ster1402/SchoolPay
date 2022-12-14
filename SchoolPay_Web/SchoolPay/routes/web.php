<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SchoolUniversityRightController;
use App\Http\Controllers\StudentController;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolStudentController;

Route::get('/', static function () {
    return view('index');
})->name('home');

Route::middleware('auth')->group(static function () {

    //School view
    Route::prefix('school')->name('school.')->group(static function () {
        //Home
        Route::get('/dashboard', static function () {
            return view('Schools.home');
        })->name('dashboard');

        //Student management
        Route::resource('student', SchoolStudentController::class);

        Route::get('/students/download-list', static function (){

        })->name('student.download-list');

        Route::get('/students/import-list', static function (){

        })->name('student.import-list');

        //University right management
        Route::prefix('university-right')->name('university-right.')->group(static function () {
            //Configuration of date
            Route::get('/date-configuration',[SchoolUniversityRightController::class, 'config'])->name('config');

            //Histories of date configuration
            Route::get('/date-configuration/history',[SchoolUniversityRightController::class, 'history'])->name('history');
        });

    });

    //Student view
    Route::prefix('student')->group(static function () {
        //Home
        Route::get('/', static function () {
            return view('Students.home');
        })->name('student.dashboard');

        //Profil
        Route::prefix('profil')->name('student.profil.')->group(static function () {
            Route::resource('student', StudentController::class)->except(['create', 'store']);
        });

        //Payments
        Route::prefix('payments')->name('student.')->group(static function () {

            Route::get('/', [PaymentController::class, 'create'])->name('payments.create');
            Route::post('/', [PaymentController::class, 'store'])->name('payments.store');
            Route::get('/history', [PaymentController::class, 'history'])->name('payments.history');

        });

    });

});

require __DIR__ . '/auth.php';
