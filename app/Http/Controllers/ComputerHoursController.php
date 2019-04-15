<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ComputerHour;
use Illuminate\Http\Request;

class ComputerHoursController extends Controller
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
            $computerhours = ComputerHour::where('duration', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $computerhours = ComputerHour::latest()->paginate($perPage);
        }

        return view('computer-hours.index', compact('computerhours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('computer-hours.create');
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
			'duration' => 'required|unique:computer_hours,duration'
		]);
        $requestData = $request->all();
        
        ComputerHour::create($requestData);

        return redirect('computer-hours')->with('flash_message', 'ComputerHour added!');
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
        $computerhour = ComputerHour::findOrFail($id);

        return view('computer-hours.show', compact('computerhour'));
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
        $computerhour = ComputerHour::findOrFail($id);

        return view('computer-hours.edit', compact('computerhour'));
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
			'duration' => 'required|unique:computer_hours,duration'
		]);
        $requestData = $request->all();
        
        $computerhour = ComputerHour::findOrFail($id);
        $computerhour->update($requestData);

        return redirect('computer-hours')->with('flash_message', 'ComputerHour updated!');
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
        ComputerHour::destroy($id);

        return redirect('computer-hours')->with('flash_message', 'ComputerHour deleted!');
    }
}
