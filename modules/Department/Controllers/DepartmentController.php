<?php

namespace Modules\Department;

use Illuminate\Http\Request;
use Pluma\Controllers\AdminController as Controller;
use Modules\Department\Department;
use Modules\Department\Requests\StoreDepartment;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resources = Department::all();
        return view('Department::index')->with( compact('resources') );
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
    public function store(StoreDepartment $request)
    {
        $department = new Department();
        $department->name = $request->input('name'); 
        $department->description = $request->input('description');
        $department->save();
        // $department->departments()->attach( $request->input('department_id') );

        $request->session()->flash('status', 'Department Saved');
        $request->session()->flash('type', 'success');

        // $request->sesion()->flash('status', 'Department already exist');
        // $request->session()->flash('type', 'error');

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
        $resource = Department::find($id);
        return view('Department::edit')->with( compact('resource') );
    }

    /**
     * Update the specified resource in storage.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @param  int  $id
     *  @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $department = Department::find($id);
        $department->name = $request->input('name'); 
        $department->description = $request->input('description');
        $department->save();
        // $type->types()->attach( $request->input('type_id') );

        $request->session()->flash('status', 'Department Updated');
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
        $department = Department::findOrFail($id);
        // $department->departments()->detach();
        $department->delete();

        session()->flash('status', 'Department Deleted');
        session()->flash('type', 'success');

        return back();
    }
}