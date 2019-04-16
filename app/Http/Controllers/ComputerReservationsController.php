<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ComputerReservation;
use Illuminate\Http\Request;

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

        $id = ComputerReservation::create($requestData)->id;
            
        if($request->ajax()){
            return $id;
        }
        return redirect('computer-reservations')->with('flash_message', 'ComputerReservation added!');
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
			// 'description' => 'required',
			// 'computer_id' => 'required|exists:computers,id',
			// 'status_id' => 'required|exists:status,id',
			// 'reserved_by' => 'required|exists:users,id',
			// 'reserved_at' => 'required'
		]);
        $requestData = $request->all();
        
        $start = new \Carbon\Carbon($requestData['start_date']);
        $end = new \Carbon\Carbon($requestData['end_date']);

        if($start->diffInHours($end) > 6){
            return abort(403, "Exceeding limit.");
        }
        
        $computerreservation = ComputerReservation::findOrFail($id);
        $computerreservation->update($requestData);

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
        ComputerReservation::destroy($id);

        return redirect('computer-reservations')->with('flash_message', 'ComputerReservation deleted!');
    }

    public function apiComputerReservations($id){
        $reservations = \App\LabReservation::where('lab_id', $id)->get();
        $keyed = $reservations->map(function ($item) {
            return[
                'start' => $item->start_date,
                'end' => $item->end_date,
                'title' => $item->reservable->name,
                'description' => $item->reservable->description,
                'id' => $item->id,
                "constraint" => "businessHours",
                "editable" => false,
                "classNames"=> ['fc-event-red']
            ];
        });
        
        $userReservations = \App\ComputerReservation::where('computer_id', $id)->get();
        $keyed_2 = $userReservations->map(function ($item) {
            return[
                'start' => $item->start_date,
                'end' => $item->end_date,
                'title' => $item->reservedBy->name . " (" . $item->reservedBy->username . ")",
                'description' => $item->description,
                'id' => $item->id,
                "constraint" => "businessHours",
                "editable" => $item->end_date < date('Y-m-d')?false:($item->reserved_by == auth()->user()->id?true:false),
                "classNames"=> $item->reserved_by == auth()->user()->id?['fc-event-green']:['fc-event-blue']
            ];
        });
        
        return $keyed->merge($keyed_2);
    }
}
