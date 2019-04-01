<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('users.index')->with('users', \App\User::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = \App\User::find($id);

        $roles = null;

        if(auth()->user()->role->name == 'admin'){
            $roles = \App\Role::all();
        }else{
            $roles = \App\Role::where('name', '<>', 'admin')->get();
        }

        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = \App\User::find($id);

        $fields = ['name', 'role_id', 'email', 'username', 'active', 'password'];

        $requestData = $request->only($fields);

        if($requestData['password'] != ''){
            $user->password = \Hash::make($requestData['password']); 
        }

        $user->name = $requestData['name'];
        $user->username = $requestData['username'];
        $user->role_id = $requestData['role_id'];
        $user->active = $requestData['active'];
        $user->email = $requestData['email'];
        $user->save();

        return redirect('users')->with('success', 'User successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
