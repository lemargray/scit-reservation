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
Route::middleware('auth')->get('/api/reservations', function (Request $request) {
    return [
        [
            'title'=> 'Dinner',
            'start'=> '2019-04-12T20:00:00'
        ],
        [
            'title'=> 'Birthday Party',
            'start'=> '2019-04-13T07:00:00'
        ],
        [
            'title'=> 'Click for Google',
            'url'=> 'http://google.com/',
            'start'=> '2019-04-28'
        ]
    ];
});