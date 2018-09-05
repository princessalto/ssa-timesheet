<?php

namespace Modules\Scheduler\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Pluma\Controllers\Controller;
use Modules\Scheduler\Scheduler;
use Modules\Client\Client;

class SchedulerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $resources = Scheduler::with('client')->get();
        $resources = Scheduler::with('client')->whereEmployeeId( auth()->user()->id )->get();

        foreach ( $resources as $resource ) {
            $resource->url = action('\Modules\Scheduler\SchedulerController@edit', $resource->id);
        }

        return response()->json( $resources );
    }

    public function widgets(Request $request)
    {
        $date = $request->input('date') ? $request->input('date') : date('Y-m-01');
        
        $resources = Scheduler::with('client')->where(DB::raw('DATE_FORMAT(date, "%Y-%m")'), date('Y-m', strtotime($date)) )->whereEmployeeId( auth()->user()->id )->get();

        return response()->json( $resources );
    }
}