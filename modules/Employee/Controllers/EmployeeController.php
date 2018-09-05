<?php

namespace Modules\Employee;

use Illuminate\Http\Request;
use Pluma\Controllers\AdminController as Controller;
use Modules\Employee\Requests\StoreEmployee;
use Modules\Employee\Requests\UpdateEmployee;
use Modules\Employee\Employee;
use Pluma\Models\User;
use Hash;
use Pluma\Models\Role;
use Modules\Department\Department;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
            // Ignores notices and reports all other kinds... and warnings
            error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
            // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
        }
        $resources = User::all();
        // dd($resources);
        return view('Employee::index')->with( compact('resources') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
            // Ignores notices and reports all other kinds... and warnings
            error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
            // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
        }
        // $resource = Employee::find();
        $roles = Role::pluck('name', 'id');
        $departments = Department::pluck('name', 'id');
        return view('Employee::create')->with( compact('resource', 'roles', 'departments') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployee $request)
    {
        // dd(Employee::find(15));
        $employee = new User();
        $employee->firstname = $request->input('firstname');
        $employee->lastname = $request->input('lastname');
        $employee->username = $request->input('username');
        $employee->email = $request->input('email');
        $employee->password = Hash::make($request->input('password'));
        $employee->save();
        $employee->roles()->attach( $request->input('role_id') );

        $detail = new Detail();
        $detail->department_id = $request->input('department_id');
        $detail->designation = $request->input('designation');
        $employee->detail()->save( $detail );

        $request->session()->flash('status', 'Employee Saved');
        $request->session()->flash('type', 'success');

        return back();
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
        if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
            // Ignores notices and reports all other kinds... and warnings
            error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
            // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
        }
        $resource = User::find($id);
        $roles = Role::pluck('name', 'id');
        $departments = Department::pluck('name', 'id');
        return view('Employee::edit')->with( compact('resource', 'roles', 'departments') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployee $request, $id)
    {
        // dd(Employee::find(15));
        $employee = User::find($id);
        $employee->firstname = $request->input('firstname');
        $employee->lastname = $request->input('lastname');
        $employee->username = $request->input('username');
        // $employee->email = $request->input('email');
        // $employee->password = $request->input('password');
        $employee->save();

        $detail = $employee->detail;

        // Create a new detail if one already doesn't exist
        if (! count($detail)) {
            $detail = new Detail();
            $detail->user_id =  $employee->id;
        }
        // Update detail data
        $detail->department_id =  $request->input('department_id');
        $detail->designation = $request->input('designation');
        // Save changes to database
        $detail->save();



        $employee->roles()->sync( $request->input('role_id') );

        $request->session()->flash('status', 'Employee Updated');
        $request->session()->flash('type', 'success');

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
        $employee = Employee::findOrFail($id);
        // $employee->types()->detach();
        $employee->delete();

        session()->flash('status', 'Employee Deleted');
        session()->flash('type', 'success');

        return back();
    }
}