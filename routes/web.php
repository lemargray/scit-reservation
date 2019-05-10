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

Route::middleware('auth')->name('reserve.computer')->get('reserve/computer/{id}', function($id){
    $computer = \App\Computer::find($id);

    $hours = \App\ComputerHour::all();
    return view('reservations.reserve')->with('computer', $computer)->with('hours', $hours);
});

Route::resource('computer-hours', 'ComputerHoursController');
Route::resource('computer-reservations', 'ComputerReservationsController');
Route::middleware('auth')->name('computer-reservation')->get('/api/computer-reservations/{id}', 'ComputerReservationsController@apiComputerReservations');

Route::get('user/{username}', function($username){
    $user = \App\User::where('username', $username)->first();
    if($user){
        if($user->role->name == 'admin'){
            return $user;
        }
        $start_date = date("Y-m-d H:m");
        $active_status_id = \App\Status::where('name', 'Active')->first()->id;
        $reservation =  \App\ComputerReservation::where('reserved_by', $user->id)
            ->where('start_date', '<=', $start_date)
            ->where('end_date', '>=', $start_date)
            ->where('status_id', $active_status_id)->first();

        if($reservation){
            $reservation->status_id = \App\Status::where('name', 'Used')->first()->id;
            $reservation->save();
        }
        return $reservation;    
    }

    return;
    // return [0=>["username" => $username]];
});

Route::middleware('auth')->name('computers-available')->get('/available/computers', 'ComputerReservationsController@search');


Route::resource('faults', 'FaultsController');

Route::post('/fault/{id}/resolve', 'FaultsController@resolve')->name('faults.resolve');