<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Fault;
use Illuminate\Http\Request;

class FaultsController extends Controller
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
    public function create(Request $request)
    {
        $active_status_id = \App\Status::where('name', 'Active')->first()->id;

        $computers = \App\Computer::where('status_id', $active_status_id)->get();

        $parent_id = $request->parent_id;

        return view('faults.create')->with('computers', $computers)->with('parent_id', $parent_id);
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
        $requestData['status_id'] = \App\Status::where('name', 'Open')->first()->id;
        $requestData['logged_by'] = auth()->user()->id;
        $requestData['logged_at'] = date('Y-m-d H:s:i');
        $fault = Fault::create($requestData);

        if($requestData['parent_id'] != ''){
            $parent = \App\Fault::find($requestData['parent_id']);
            $parent->status_id = $requestData['status_id'];
            $parent->save();
        }

        if($request->hasfile('upload'))
         {
            foreach($request->file('upload') as $file)
            {
                $name=$file->getClientOriginalName();
                $file->move(public_path().'/files/', $name); 
                $faultImage = new \App\FaultImage(); 
                $faultImage->path = '/files/' . $name;  
                $faultImage->fault_id = $fault->id;             
                $faultImage->save();
            }
         }
        

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
        $status_closed_id = \App\Status::where('name', 'Closed')->first()->id;

        $fault = Fault::find($id);
        $fault->status_id = $status_closed_id;
        $fault->actioned_by = auth()->user()->id;
        $fault->actioned_at = date('Y-m-d H:s:i');
        $fault->save();

        return redirect('faults')->with('flash_message', 'Fault Closed!');
    }
}
