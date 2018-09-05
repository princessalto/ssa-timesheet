<?php

namespace Modules\Employee;

use Illuminate\Http\Request;
use Pluma\Controllers\AdminController as Controller;
use Modules\Employee\Employee;
use Modules\Employee\Requests\UpdatePassword;
use Hash;

class PasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resources = Employee::all();
        return view('Employee::index')->with( compact('resources') );
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
        $resource = Employee::find($id);
        return view('Employee::edit')->with( compact('resource') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePassword $request, $id)
    {
        $employee = Employee::find($id);

        if ( Hash::check( $request->input('old_password'), $employee->password ) ) {
            $employee->password = Hash::make( $request->input('password') );
            $employee->save();

            $request->session()->flash('status', 'Employee Updated');
            $request->session()->flash('type', 'success');
        } else {
            $request->session()->flash('status', 'Incorrect password');
            $request->session()->flash('type', 'danger');
        }
        // dd(Hash::make("ww"));

        // $type->types()->attach( $request->input('type_id') ); 

        return back();
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