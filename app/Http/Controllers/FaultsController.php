<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Fault;
use Illuminate\Http\Request;

class FaultsController extends Controller
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
            $faults = Fault::where('computer_id', 'LIKE', "%$keyword%")
                ->orWhere('status_id', 'LIKE', "%$keyword%")
                ->orWhere('logged_by', 'LIKE', "%$keyword%")
                ->orWhere('logged_at', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('actioned_by', 'LIKE', "%$keyword%")
                ->orWhere('actioned_at', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $faults = Fault::latest()->paginate($perPage);
        }

        return view('faults.index', compact('faults'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $active_status_id = \App\Status::where('name', 'Active')->first()->id;

        $computers = \App\Computer::where('status_id', $active_status_id)->get();

        return view('faults.create')->with('computers', $computers);
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
			'computer_id' => 'required|exists:computers,id',
			'description' => 'required'
		]);
        $requestData = $request->all();
        
        Fault::create($requestData);

        return redirect('faults')->with('flash_message', 'Fault added!');
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
        $fault = Fault::findOrFail($id);

        return view('faults.show', compact('fault'));
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
        $fault = Fault::findOrFail($id);

        return view('faults.edit', compact('fault'));
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
			'computer_id' => 'required|exists:computers,id',
			'description' => 'required'
		]);
        $requestData = $request->all();
        
        $fault = Fault::findOrFail($id);
        $fault->update($requestData);

        return redirect('faults')->with('flash_message', 'Fault updated!');
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
        Fault::destroy($id);

        return redirect('faults')->with('flash_message', 'Fault deleted!');
    }
}
