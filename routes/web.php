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
    return view('pages/login');
});

Route::get('/mainPage', function() {
    return view('pages/mainPage');
})->middleware('auth');

Route::get('/patients', 'PatientsController@getPatients')->middleware('auth');

Route::get('/visits/{id}', 'VisitsController@getPatientHistory')->middleware('auth');

Route::get('/doctors/visits', 'VisitsController@listDoctorVisitsForToday')->middleware('auth');
Route::get('/doctors/visits/{id}/viewHistory', 'VisitsController@listPatientVisitsHistory')->middleware('auth');


Route::get('patients/{id}/register-visit', 'VisitsController@registerVisit')->middleware('auth');
Route::post('patients/{id}/register-visit', 'VisitsController@postRegisterVisit')->middleware('auth');

Route::get('patients/insert', 'PatientsController@insertPatient')->middleware('auth');
Route::post('patients/insert', 'PatientsController@postInsertPatient')->middleware('auth');
Route::post('patients/{id}/edit-visit', 'VisitsController@editVisit')->middleware('auth');

Route::get('ajaxdate', 'VisitsController@ajaxDate');

Route::get('patients/unregister', 'PatientsController@unregisterPatient')->middleware('auth');
Route::get('patients/unregister', 'PatientsController@postUnregisterPatient')->middleware('auth');

Route::get('patients/{id}/pending-visit', 'VisitsController@pendingVisits')->middleware('auth');
Route::get('patients/{id}/remove-visit', 'VisitsController@removePendingVisit')->middleware('auth');

Auth::routes();

Route::get('/home', function() {
    return view('pages/mainPage');
})->middleware('auth');