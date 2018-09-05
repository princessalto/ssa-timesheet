<?php

namespace Modules\Type;

use Illuminate\Http\Request;
use Pluma\Controllers\AdminController as Controller;
use Modules\Type\Type;
use Modules\Type\Requests\StoreType;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resources = Type::all();
        return view('Type::index')->with( compact('resources') );
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
    public function store(StoreType $request)
    {
        $type = new Type();
        $type->name = $request->input('name'); 
        $type->description = $request->input('description');
        $type->save();
        // $type->types()->attach( $request->input('type_id') );

        $request->session()->flash('status', 'Type Saved');
        $request->session()->flash('type', 'success');

        // $request->sesion()->flash('status', 'Type already exist');
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
        $resource = Type::find($id);
        return view('Type::edit')->with( compact('resource') );
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
        $type = Type::find($id);
        $type->name = $request->input('name'); 
        $type->description = $request->input('description');
        $type->save();
        // $type->types()->attach( $request->input('type_id') );

        $request->session()->flash('status', 'Type Updated');
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
        $type = Type::findOrFail($id);
        // $type->types()->detach();
        $type->delete();

        session()->flash('status', 'Type Deleted');
        session()->flash('type', 'success');

        return back();
    }

    public function destroyMany(Request $request)
    {
        $type = Type::destroy($request->input('types'));

        session()->flash('status', 'Type Deleted');
        session()->flash('type', 'success');

        return back();
    }
}