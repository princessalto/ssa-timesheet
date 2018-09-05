<?php

namespace Modules\Client;

use Illuminate\Http\Request;
use Pluma\Controllers\AdminController as Controller;
use Modules\Client\Requests\StoreClient;
use Modules\Client\Client;
use Modules\Type\Type;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resources = Client::all();
        return view('Client::index')->with( compact('resources') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::pluck('name', 'id');
        return view('Client::create')->with( compact(['types']) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClient $request)
    {
        $client = new Client();
        $client->name = $request->input('name');
        $client->description = $request->input('description');
        $client->save();
        $client->types()->attach( $request->input('type_id') );

        $request->session()->flash('status', 'Type Saved');
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
        $resource = Client::find($id);
        $types = Type::pluck('name', 'id');
        return view('Client::edit')->with( compact(['resource', 'types']) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreClient $request, $id)
    {
        $client = Client::find($id);
        $client->name = $request->input('name');
        $client->description = $request->input('description');
        $client->types()->sync( [ $request->input('type_id') ] );
        $client->save();

        $request->session()->flash('status', 'Client Updated');
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
        $client = Client::findOrFail($id);
        $client->types()->detach();
        $client->delete();

        session()->flash('status', 'Client Deleted');
        session()->flash('type', 'success');

        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function types()
    {
        $resources = Type::paginate(5);
        return view('Type::index')->with( compact('resources') );
    }
}