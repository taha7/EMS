<?php

use Illuminate\Support\Facades\Route;


Route::get('/investors', 'InvestorsController@getAll');

Route::group(['namespace' => 'WebApi'], function () {
    Route::get('/schedule', 'ScheduleController@generateSchedule');
    Route::get('/investors', 'InvestorsController@index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
