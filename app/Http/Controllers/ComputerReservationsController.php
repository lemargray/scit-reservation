<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ComputerReservation;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\MessageBag;

class ComputerReservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $computerreservations = ComputerReservation::where('start_date', 'LIKE', "%$keyword%")
                ->orWhere('end_date', 'LIKE', "%$keyword%")
                ->orWhere('computer_id', 'LIKE', "%$keyword%")
                ->orWhere('status_id', 'LIKE', "%$keyword%")
                ->orWhere('reserved_by', 'LIKE', "%$keyword%")
                ->orWhere('reserved_at', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $computerreservations = ComputerReservation::latest()->paginate($perPage);
        }

        return view('computer-reservations.index', compact('computerreservations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('computer-reservations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'start_date' => 'required',
			'end_date' => 'required',
			// 'description' => 'required',
			'computer_id' => 'required|exists:computers,id',
		]);
        $requestData = $request->all();
        $requestData['reserved_by'] = auth()->user()->id;
        $requestData['reserved_at'] = date('Y-m-d');
        $requestData['status_id'] = 1;

        if( $this->alreadyExist($requestData['start_date'], $requestData['end_date']) ){
            return abort(403, "A Reservation already exist for that time slot. Please refresh to see changes.");
        }

        if($this->maxTimeExceeded($requestData['start_date'], $requestData['end_date'])){
            return abort(403, "Exceeding limit.");
        }

        $reservation = ComputerReservation::create($requestData);

        $reserved = new \App\Mail\ComputerReserved($reservation);

        Mail::to($request->user())->send($reserved);

        broadcast(new \App\Events\Reservation());
            
        if($request->ajax()){
            return $reservation->id;
        }
        return redirect('computer-reservations')->with('flash_message', 'Computer Reservation added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $computerreservation = ComputerReservation::findOrFail($id);

        return view('computer-reservations.show', compact('computerreservation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $computerreservation = ComputerReservation::findOrFail($id);

        return view('computer-reservations.edit', compact('computerreservation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'start_date' => 'required',
			'end_date' => 'required',
        ]);
        
        $requestData = $request->all();
        
        if($this->maxTimeExceeded($requestData['start_date'], $requestData['end_date'])){
            return abort(403, "Exceeding limit.");
        }
        
        if( $this->alreadyExist($requestData['start_date'], $requestData['end_date'], $id) ){
            return abort(403, "A Reservation already exist for that time slot. Please refresh to see changes.");
        }
        
        $computerreservation = ComputerReservation::findOrFail($id);
        $computerreservation->update($requestData);

        // mail to

        broadcast(new \App\Events\Reservation());

        if($request->ajax()){
            return "Reservation reschedule successfully.";
        }

        return redirect('computer-reservations')->with('flash_message', 'ComputerReservation updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $reservation = ComputerReservation::findOrFail($id);

        // Check if the person login into the computer if yes do not cancel
        // user/{username} should set a flag on the reservation record to 1
        if($reservation->end_date <= date('Y-m-d H:i:s')){
            return abort(403, "Cannot cancel a reservation that already finished");
        }

        $reservation->status_id = \App\Status::where('name', 'Cancel')->first()->id;
        $reservation->save();

        broadcast(new \App\Events\Reservation());

        if($request->ajax()){
            return "Reservation cancelled successfully.";
        }

        return redirect('computer-reservations')->with('flash_message', 'ComputerReservation deleted!');
    }

    public function apiComputerReservations($id){
        $start_date = date('Y-m-d H:i:s', strtotime(request()->query('start')));
        $end_date = date('Y-m-d H:i:s', strtotime(request()->query('end')));
        $active_status_id = \App\Status::where('name', 'Active')->first()->id;
        $reservations = \App\LabReservation::where('lab_id', $id)
            ->where('start_date', '>=', $start_date)
            ->where('start_date', '<', $end_date)
            ->where('end_date', '<=', $end_date)
            ->where('status_id', $active_status_id)
            ->get();
        $keyed = $reservations->map(function ($item) {
            return[
                'start' => $item->start_date,
                'end' => $item->end_date,
                'title' => $item->reservable->name,
                'description' => $item->reservable->description,
                // 'id' => $item->id,
                "constraint" => "businessHours",
                "editable" => false,
                "classNames"=> ['fc-event-red']
            ];
        });
        
        $userReservations = \App\ComputerReservation::where('computer_id', $id)
            ->where('start_date', '>=', $start_date)
            ->where('start_date', '<', $end_date)
            ->where('end_date', '<=', $end_date)   
            ->where('status_id', $active_status_id)
            ->get();

        $keyed_2 = $userReservations->map(function ($item) {
            return[
                'start' => $item->start_date,
                'end' => $item->end_date,
                'title' => $item->reservedBy->name . " (" . $item->reservedBy->username . ")",
                'description' => $item->description,
                'id' => $item->id,
                "constraint" => "businessHours",
                "editable" => $item->end_date < date('Y-m-d H:i:s')?false:($item->reserved_by == auth()->user()->id?true:false),
                "classNames"=> $item->reserved_by == auth()->user()->id?['fc-event-green']:['fc-event-blue']
            ];
        });
        
        return array_merge($keyed->all(), $keyed_2->all());
    }

    public function alreadyExist($start_date, $end_date, $id = null)
    {
        $query = ComputerReservation::where('start_date', '<=', $start_date)
                ->where(function($q) use($start_date, $end_date){
                    $q->where('end_date', '>', $start_date)
                    ->orWhere([
                        ['start_date', '<', $end_date],
                        ['end_date', '>=', $end_date]
                    ]);
                });

        if($id !== null){
            $query->where('id', '!=', $id);
        }

        $computerAlreadyExist = $query->get();

        $labAlreadyExist = \App\LabReservation::where('start_date', '<=', $start_date)
                ->where(function($q) use($start_date, $end_date){
                    $q->where('end_date', '>', $start_date)
                    ->orWhere([
                        ['start_date', '<', $end_date],
                        ['end_date', '>=', $end_date]
                    ]);
                })->get();

        if($computerAlreadyExist->isNotEmpty() && $labAlreadyExist->isNotEmpty()){
            return true;
        }

        return false;
    }

    public function search(Request $request)
    {
        $start_time = $request->date.' '.date("H:i:s", strtotime($request->start_time));
        $end_time = $request->date.' '.date("H:i:s", strtotime($request->end_time));
        $computers = \App\Computer::whereHas("lab.labReservations", function($q) use($start_time, $end_time){
                $q->where('start_date', '>=', $start_time)
                    ->where([
                        ['end_date', '<=', $end_time]
                    ]
                );
            })->orWhereHas("computerReservations", function($q) use($start_time, $end_time){
                $q->where('start_date', '>=', $start_time)
                ->where([
                    ['end_date', '<=', $end_time]
                ]);
            })->get()->map(function($item){
                return $item->id;
            });

        $labs = \App\Lab::with(['computers' => function($q) use($computers){
            $q->whereNotIn('computers.id', $computers);
        }])->get();

        $request->flash();
        
        return view("reservations.create")->with("labs", $labs)->with("is_search", true);
    }

    public function maxTimeExceeded($start_date, $end_date)
    {
        $start = new \Carbon\Carbon($start_date);
        $end = new \Carbon\Carbon($end_date);
        //fetch from settings table
        if($start->diffInHours($end) > 6){
            return true;
        }

        return false;
    }
}
