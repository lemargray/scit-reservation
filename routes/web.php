<?php

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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/users', 'UsersController@index')->name('users');
Route::get('/user/{id}/edit', 'UsersController@edit')->name('edit-user');
Route::post('/user/{id}', 'UsersController@update')->name('update-user');

Route::resource('faults', 'FaultsController');
Route::resource('reservations', 'ReservationsController');

Route::get('test/created', function(){
    return view('test');
})->name('test');
Route::resource('labs', 'LabsController');
Route::get('lab/{id}/reservations', 'LabsController@reservations')->name('labs.reservations');
Route::resource('computers', 'ComputersController');
Route::resource('courses', 'CoursesController');
Route::resource('closures', 'ClosuresController');
Route::resource('lab-reservations', 'LabReservationsController');
Route::middleware('auth')->name('lab-reservation')->get('/api/reservations/{id}', 'LabReservationsController@apiLabReservations');

Route::middleware('auth')->name('reserve.lab')->get('reserve/lab/{id}', function($id){
    $lab = \App\Lab::find($id);

    $courses = \App\Course::all();
    $closures = \App\Closure::all();
    return view('labs.reserve')->with('lab', $lab)->with('courses', $courses)->with('closures', $closures);
});

