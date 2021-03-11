<?php

use App\Events\SlotUpdatedEvent;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     event(new SlotUpdatedEvent('Hello Slot'));
//     return [];
// });

Route::get('/investors', 'InvestorsController@getAll');

Route::group(['namespace' => 'WebApi'], function () {
    Route::get('/schedule', 'ScheduleController@generateSchedule');
    Route::get('/investors', 'InvestorsController@index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
