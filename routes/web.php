<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('pages/mainPage');
});

Route::get('/patients', 'PatientsController@getPatients');

Route::get('/visits/{id}', 'VisitsController@getPatientHistory');

Route::get('/doctors', 'DoctorsController@getDoctors');


Route::get('patients/{id}/register-visit', 'VisitsController@registerVisit');
Route::post('patients/{id}/register-visit', 'VisitsController@postRegisterVisit');

Route::get('patients/insert', 'PatientsController@insertPatient');
Route::post('patients/insert', 'PatientsController@postInsertPatient');
Route::post('patients/{id}/edit-visit', 'VisitsController@editVisit');

Route::get('ajaxdate', 'VisitsController@ajaxDate');

Route::get('patients/unregister', 'PatientsController@unregisterPatient');
Route::get('patients/unregister', 'PatientsController@postUnregisterPatient');

Route::get('patients/{id}/pending-visit', 'VisitsController@pendingVisits');
Route::get('patients/{id}/remove-visit', 'VisitsController@removePendingVisit');

Auth::routes();

Route::get('/home', 'HomeController@index');
