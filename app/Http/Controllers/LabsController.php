<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Lab;
use Illuminate\Http\Request;

class LabsController extends Controller
{
    public function __construct(){
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
            $labs = Lab::with(['status'])
                ->whereHas('status',function($query) use ($keyword){
                    $query->where("name","LIKE","%$keyword%");
                })
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('opening_time', 'LIKE', "%$keyword%")
                ->orWhere('closing_time', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $labs = Lab::latest()->paginate($perPage);
        }

        return view('labs.index', compact('labs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $statuses = \App\Status::all(['id', 'name']);

        return view('labs.create', compact('statuses'));
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
			'name' => 'required|max:191',
			'opening_time' => 'required',
			'closing_time' => 'required',
			'status_id' => 'required|exists:status,id'
        ]);
        
        $requestData = $request->all();
        $requestData['user_id'] = auth()->user()->id;
        
        Lab::create($requestData);

        return redirect('labs')->with('flash_message', 'Lab added!');
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
        $lab = Lab::findOrFail($id);

        return view('labs.show', compact('lab'));
    }

    public function reservations($id)
    {
        return view('labs.reservations');
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
        $lab = Lab::findOrFail($id);
        $statuses = \App\Status::all(['id', 'name']);

        return view('labs.edit', compact('lab', 'statuses'));
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
			'name' => 'required|max:191',
			'opening_time' => 'required',
			'closing_time' => 'required',
			'status_id' => 'required|exists:status,id'
		]);
        $requestData = $request->all();
        
        $lab = Lab::findOrFail($id);
        $lab->update($requestData);

        return redirect('labs')->with('flash_message', 'Lab updated!');
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
        Lab::destroy($id);

        return redirect('labs')->with('flash_message', 'Lab deleted!');
    }
}
