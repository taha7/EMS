<?php

use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'WebApi\\Reports'], function () {
    Route::get('/company-schedule-with-investor-contacts', 'CompanyScheduleWithInvestorContactsController')
        ->name('company.schedule.with.investor.contacts');
});
