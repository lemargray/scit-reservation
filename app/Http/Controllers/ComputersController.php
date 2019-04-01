<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Computer;
use Illuminate\Http\Request;

class ComputersController extends Controller
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
            $computers = Computer::with(['lab', 'status'])
            ->whereHas('lab',function($query) use ($keyword){
                $query->where("name","LIKE","%$keyword%");
            })
            ->orWhereHas('status',function($query) use ($keyword){
                $query->where("name","LIKE","%$keyword%");
            })
            ->orWhere('name', 'LIKE', "%$keyword%")
            ->orWhere('description', 'LIKE', "%$keyword%")
            ->latest()->paginate($perPage);
        } else {
            $computers = Computer::latest()->paginate($perPage);
        }

        return view('computers.index', compact('computers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $statuses = \App\Status::all();
        $labs = \App\Lab::all();

        return view('computers.create', compact('statuses', 'labs'));
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
			'description' => 'required',
			'lab_id' => 'required|exists:labs,id',
			'status_id' => 'required|exists:status,id'
		]);
        $requestData = $request->all();
        
        Computer::create($requestData);

        return redirect('computers')->with('flash_message', 'Computer added!');
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
        $computer = Computer::findOrFail($id);

        return view('computers.show', compact('computer'));
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
        $computer = Computer::findOrFail($id);
        $labs = \App\Lab::all();
        $statuses = \App\Status::all();

        return view('computers.edit', compact('computer', 'statuses', 'labs'));
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
			'description' => 'required',
			'lab_id' => 'required|exists:labs,id',
			'status_id' => 'required|exists:status,id'
		]);
        $requestData = $request->all();
        
        $computer = Computer::findOrFail($id);
        $computer->update($requestData);

        return redirect('computers')->with('flash_message', 'Computer updated!');
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
        Computer::destroy($id);

        return redirect('computers')->with('flash_message', 'Computer deleted!');
    }
}
