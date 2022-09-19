<?php

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

Route::get('/', static function () {
    return view('index');
})->name('home');

Route::middleware('auth')->group(static function () {

    //School view
    Route::prefix('school')->group(static function () {
        //Home
        Route::get('/dashboard', static function () {
            return view('Schools.home');
        })->name('school.dashboard');

        //Student management
        Route::prefix('student')->group(static function () {
            //View the list of students and filter
            Route::get('/view', static function () {

            })->name('school.student.index');


        });

        //University right management
        Route::prefix('university-right')->group(static function () {
            //Configuration of date
            Route::get('/date-configuration', static function () {

            })->name('school.university-right.config');

            //Histories of date configuration
            Route::get('/date-configuration/history', static function () {

            })->name('school.university-right.history');
        });

    });

    //Student view
    Route::prefix('student')->group(static function () {
        //Home
        Route::get('/', static function () {
            return view('Students.home');
        })->name('student.dashboard');
    });

});

require __DIR__ . '/auth.php';
