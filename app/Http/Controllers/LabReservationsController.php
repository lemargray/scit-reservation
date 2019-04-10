<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\LabReservation;
use Illuminate\Http\Request;

class LabReservationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
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
            $labreservations = LabReservation::where('start_date', 'LIKE', "%$keyword%")
                ->orWhere('end_date', 'LIKE', "%$keyword%")
                ->orWhere('lab_id', 'LIKE', "%$keyword%")
                ->orWhere('status_id', 'LIKE', "%$keyword%")
                ->orWhere('reserved_by', 'LIKE', "%$keyword%")
                ->orWhere('reserved_at', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('reservable_id', 'LIKE', "%$keyword%")
                ->orWhere('reservable_type', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $labreservations = LabReservation::latest()->paginate($perPage);
        }

        return view('lab-reservations.index', compact('labreservations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('lab-reservations.create');
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
			'description' => 'required',
			'lab_id' => 'required|exists:labs,id',
			'status_id' => 'required|exists:status,id',
			'reserved_by' => 'required|exists:users,id',
			'reserved_at' => 'required'
		]);
        $requestData = $request->all();
        
        LabReservation::create($requestData);

        return redirect('lab-reservations')->with('flash_message', 'LabReservation added!');
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
        $labreservation = LabReservation::findOrFail($id);

        return view('lab-reservations.show', compact('labreservation'));
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
        $labreservation = LabReservation::findOrFail($id);

        return view('lab-reservations.edit', compact('labreservation'));
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
        // $this->validate($request, [
		// 	'start_date' => 'required',
		// 	'end_date' => 'required',
		// 	// 'status_id' => 'exists:status,id',
		// ]);
        $requestData = $request->only(['start_date', 'end_date']);
        // $requestData['reserved_by'] = auth()->user()->id;
        // $requestData['reserved_at'] = date(); 
        
        $labreservation = LabReservation::findOrFail($id); 
        
        // if($requestData['status_id'] == ''){
        //     $requestData['status_id'] = $labreservation['status_id'];
        // }
        $labreservation->start_date = $requestData['start_date'];
        $labreservation->end_date = $requestData['end_date'];
        $labreservation->save();die;
        // $labreservation->update($requestData);die;

        if($request->wantsJson()){
            return ["Yes"];
        }

        return redirect('lab-reservations')->with('flash_message', 'LabReservation updated!');
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
        LabReservation::destroy($id);

        return redirect('lab-reservations')->with('flash_message', 'LabReservation deleted!');
    }

    public function apiLabReservations($id){
        $reservations = \App\LabReservation::where('lab_id', $id)->get();
        $keyed = $reservations->mapWithKeys(function ($item) {
            $a = explode(' ', $item->start_date);
            $arr['start'] = $item->start_date;///$a[0] . 'T' . $a[1];
            $arr['end'] = $item->end_date;
            $arr['title'] = $item->reservable->name;
            $arr['description'] = 'Just testing';
            $arr['id'] = $item->id;
            return $arr;
        });
        return [$keyed->all()];
    }
}
