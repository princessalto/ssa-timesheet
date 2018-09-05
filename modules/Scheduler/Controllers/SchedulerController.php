<?php

namespace Modules\Scheduler;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Pluma\Controllers\AdminController as Controller;
use Pluma\Models\Calendar;
use Modules\Scheduler\Scheduler;
use Modules\Client\Client;
use Modules\Scheduler\Requests\StoreScheduler;
use Pluma\Helpers\Time;
use DateTime;
use Excel;
use Modules\Employee\Employee;
use Modules\Scheduler\Tag;

class SchedulerController extends Controller
{
    protected $resources;

    public function __construct()
    {
        $this->middleware( ['web', 'auth.admin', 'roles:admin,employee'] );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resources = Scheduler::all();
        $clients = Client::pluck( 'name', 'id' );

        $r = Scheduler::all();
        $i = [];
        $b = [];
        // $time = [];
        foreach ($r as $p) {
            // dd($p->client);
            $i[ $p->client->name ] = $p->client;

            $b[ $p->client->types[0]->name ] = $p;

            $time = strtotime(date("Y-m-d H:i:s", strtotime($p->end_time))) - strtotime(date("Y-m-d H:i:s", strtotime($p->start_time)));
            // dd( date("Y-m-d H:i:s", $time) );
            $widgets["total_types"][ $p->client->types[0]->name ][] = $time;
        }

        foreach ($b as $name => $bb) {
            // dd($widgets["total_types"][$name]);
        }

        $widgets['total_tasks'] = str_pad(count($i), 2, "0", STR_PAD_LEFT);
        $widgets['total_billable'] = $b;//str_pad(count($b), 2, "0", STR_PAD_LEFT);
        return view('Scheduler::index')->with( compact(['resources' , 'clients', 'widgets']) );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::pluck('name', 'id');
        $tags = Tag::pluck('name');
        return view('Scheduler::create')->with( compact(['clients', 'tags']) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreScheduler $request)
    {
        // $date = explode(" - ", $request->input('time'));
        // dd($request);
        $scheduler = new Scheduler();
        // $scheduler->name = $request->input('name');
        $scheduler->client_id = $request->input('client_id');
        $scheduler->employee_id = auth()->user()->id;
        $scheduler->description = $request->input('description');
        $scheduler->date = date( 'Y-m-d', strtotime( $request->input('date') ) );
        $scheduler->start_time = date( 'H:i:s', strtotime( $request->input('start_time') ) );
        $scheduler->end_time = date( 'H:i:s', strtotime( $request->input('end_time') ) );
        $scheduler->save();

        if ( !Tag::whereName( $request->input('description') )->exists() ) {
            $tag = new Tag();
            $tag->name = $request->input('description');
            $tag->save();
        }

        $request->session()->flash('status', 'Schedule Created');
        $request->session()->flash('type', 'success');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $start_date = date('Y-m-01', strtotime($request->input('date') ? $request->input('date') : date('Y-m-01')));
        $end_date = date('Y-m-d', strtotime("$start_date +1 month -1 day"));
        $resources = Scheduler::whereEmployeeId($id)->where(DB::raw('DATE_FORMAT(date, "%Y-%m")'), date('Y-m', strtotime($start_date)) )->orderBy('client_id', 'ASC')->get();
        $r = [];
        foreach ( $resources as $i => $resource ) {
            $calendars = Calendar::leftJoin('schedulers', function ($join) use ($resource, $id) {
                $join->on('calendars.date', '=', 'schedulers.date');
                $join->where('schedulers.employee_id', $id);
                $join->where('schedulers.client_id', $resource->client_id);
                $join->where('schedulers.description', $resource->description);
            })->select( DB::raw('*, calendars.date AS calendardate, TIME_FORMAT( SEC_TO_TIME( SUM( TIME_TO_SEC( TIMEDIFF(schedulers.end_time, schedulers.start_time) ))), "%h:%i:%s" ) as total_time') )->whereBetween( 'calendars.date', [$start_date, $end_date] )->orderBy('calendars.date', 'ASC')->orderBy('schedulers.client_id', 'ASC')->groupBy('calendars.date')->get();
            $subtotal = [];
            foreach ( $calendars as $j => $calendar ) {
                // $total = Time::total($calendar->start_time, $calendar->end_time);
                // $calendar->hours = Time::to_points($total);
                // dd($calendar->total_time);
                $calendar->hours = $calendar->total_time ? Time::to_points( $calendar->total_time ) : "";
                // dd($calendar->hours);
                $resource->totalhours += ! empty($calendar->hours) ? $calendar->hours : 0;
                $subtotal['hours'][$j] = (float) 0.0;
                $subtotal['hours'][$j] += ! empty($calendar->hours) ? $calendar->hours : 0;
                $subtotal['totalhours'] = (float) 0.0;
                $subtotal['totalhours'] = $resource->totalhours;
            }
            $resource->calendar = $calendars;
            $resource->subtotal = $subtotal;
            $r[$resource->client->name][$resource->description] = $resource;
        }
        $resources = $r;
        $r = [];
        foreach ($resources as $clientname => $collections) {
            foreach ($collections as $description => $resource) {
                $r[ $resource->client->types[0]->name ]['info']["$clientname - $description"][] = $resource;
                $r[ $resource->client->types[0]->name ]['subtotal']['hours'][] = $resource->subtotal['hours'];
            }
        }
        foreach ($r as $type => $rr) {
            $array = $rr['subtotal']['hours'];
            $keys = array_keys(array_reduce($array, function ($keys, $arr) { return $keys + $arr; }, array()));
            $sums = array();
            foreach ($keys as $key) {
                $sums[$key] = array_reduce($array, function ($sum, $arr) use ($key) { return $sum + @$arr[$key]; });
            }
            $r[ $type ]['subtotal']['hours'] = $sums;
            $r[ $type ]['subtotal']['totalhours'] = 0;
            foreach ( $r[ $type ]['subtotal']['hours'] as $hours ) {
                $r[ $type ]['subtotal']['totalhours'] += $hours;
            }
        }
        // $grandtotal['hours'] = [];
        $grandtotal['totalhours'] = 0;
        foreach ($r as $type => $res) {
            $subtotal = $res['subtotal']['totalhours'];
            $grandtotal['totalhours'] += $subtotal;
            $grandtotal['hours'][] = $res['subtotal']['hours'];
        }
        $array = isset( $grandtotal['hours'] ) ? $grandtotal['hours'] : [];
        $keys = array_keys(array_reduce($array, function ($keys, $arr) { return $keys + $arr; }, array()));
        $sums = array();
        foreach ($keys as $key) {
            $sums[$key] = array_reduce($array, function ($sum, $arr) use ($key) { return $sum + @$arr[$key]; });
        }
        $grandtotal['hours'] = $sums;
        $resources = $r;
        $calendars = Calendar::whereBetween( 'calendars.datetime', [$start_date, $end_date] )->orderBy('calendars.date', 'ASC')->get();
        $date = date('F Y', strtotime("$start_date"));
        $employee_id = $id;

        $months = Calendar::whereBetween('date', [date('Y-01-01'), date('Y-12-01')])->groupBy('month')->get();
        // dd($months);

        return view('Scheduler::show')->with( compact(['resources', 'calendars', 'grandtotal', 'date', 'employee_id', 'months']) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $resource = Scheduler::find($id);
        $clients = Client::pluck('name', 'id');
        $tags = Tag::pluck('name');
        return view('Scheduler::edit')->with( compact( ['resource', 'clients', 'tags'] ) );
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
        $time = explode(" - ", $request->input('time'));
        $scheduler = Scheduler::find($id);
        $scheduler->client_id = $request->input('client_id');
        $scheduler->employee_id = auth()->user()->id;
        $scheduler->description = $request->input('description');
        $scheduler->start_time = date( 'H:i:s', strtotime( $request->input('start_time') ) );
        $scheduler->end_time = date( 'H:i:s', strtotime( $request->input('end_time') ) );
        $scheduler->date = date( 'Y-m-d', strtotime( $request->input('date') ) );
        // dd($scheduler);
        $scheduler->save();

        if ( !Tag::whereName( $request->input('description') )->exists() ) {
            $tag = new Tag();
            $tag->name = $request->input('description');
            $tag->save();
        }

        $request->session()->flash('status', 'Scheduler Updated');
        $request->session()->flash('type', 'success');

        return redirect( action('\Modules\Scheduler\SchedulerController@index') );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $scheduler = Scheduler::findOrFail($id);
        // $employee->types()->detach();
        $scheduler->delete();

        session()->flash('status', 'Schedule Deleted');
        session()->flash('type', 'success');

        return redirect( action('\Modules\Scheduler\SchedulerController@index') );
    }

    public function generate(Request $request, $id)
    {
        $employee = Employee::with('detail')->find($id);
        $date = $request->input('date') ? date("Y-m-d", strtotime( $request->input('date') )) : date('Y');
        $month = date("M", strtotime( $date ));
        $year = date("Y", strtotime( $date ));
        $filename = "{$employee->lastname} {$employee->firstname}_$month $year";
        dd('excel');
        // Excel::create($filename, function($excel) use ($id, $month, $year) {

        //     $excel->sheet('New sheet', function($sheet) use ($id, $month, $year) {
        //         // $resources = Scheduler::whereEmployeeId($id)->orderBy('client_id', 'ASC')->get();
        //         $start_date = date('Y-m-01', strtotime($month));
        //         $end_date = date('Y-m-d', strtotime("$start_date +1 month -1 day"));
        //         $r = [];
        //         $resources = Scheduler::whereEmployeeId($id)->where(DB::raw('DATE_FORMAT(date, "%Y-%m")'), date('Y-m', strtotime($start_date)) )->orderBy('client_id', 'ASC')->get();
        //         foreach ( $resources as $i => $resource ) {
        //             $calendars = Calendar::leftJoin('schedulers', function ($join) use ($resource, $id) {
        //                 $join->on('calendars.date', '=', 'schedulers.date');
        //                 $join->where('schedulers.employee_id', $id);
        //                 $join->where('schedulers.client_id', $resource->client_id);
        //                 $join->where('schedulers.description', $resource->description);
        //             })->select( DB::raw('*, calendars.date AS calendardate, TIME_FORMAT( SEC_TO_TIME( SUM( TIME_TO_SEC( TIMEDIFF(schedulers.end_time, schedulers.start_time) ))), "%h:%i:%s" ) as total_time') )->whereBetween( 'calendars.date', [$start_date, $end_date] )->orderBy('calendars.date', 'ASC')->orderBy('schedulers.client_id', 'ASC')->groupBy('calendars.date')->get();
        //             $subtotal = [];
        //             foreach ( $calendars as $j => $calendar ) {
        //                 // $total = Time::total($calendar->start_time, $calendar->end_time);
        //                 // $calendar->hours = Time::to_points($total);
        //                 $calendar->hours = Time::to_points( $calendar->total_time ? $calendar->total_time : "00:00:00" );
        //                 $resource->totalhours += $calendar->hours;
        //                 $subtotal['hours'][$j] = (float) 0.0;
        //                 $subtotal['hours'][$j] += $calendar->hours;
        //                 $subtotal['totalhours'] = (float) 0.0;
        //                 $subtotal['totalhours'] = $resource->totalhours;
        //             }
        //             $resource->calendar = $calendars;
        //             $resource->subtotal = $subtotal;
        //             $r[$resource->client->name][$resource->description] = $resource;
        //         }
        //         $resources = $r;
        //         $r = [];
        //         foreach ($resources as $clientname => $collections) {
        //             foreach ($collections as $description => $resource) {
        //                 $r[ $resource->client->types[0]->name ]['info']["$clientname - $description"][] = $resource;
        //                 $r[ $resource->client->types[0]->name ]['subtotal']['hours'][] = $resource->subtotal['hours'];
        //             }
        //         }
        //         foreach ($r as $type => $rr) {
        //             $array = $rr['subtotal']['hours'];
        //             $keys = array_keys(array_reduce($array, function ($keys, $arr) { return $keys + $arr; }, array()));
        //             $sums = array();
        //             foreach ($keys as $key) {
        //                 $sums[$key] = array_reduce($array, function ($sum, $arr) use ($key) { return $sum + @$arr[$key]; });
        //             }
        //             $r[ $type ]['subtotal']['hours'] = $sums;
        //             $r[ $type ]['subtotal']['totalhours'] = 0;
        //             foreach ( $r[ $type ]['subtotal']['hours'] as $hours ) {
        //                 $r[ $type ]['subtotal']['totalhours'] += $hours;
        //             }
        //         }
        //         // $grandtotal['hours'] = [];
        //         $grandtotal['totalhours'] = 0;
        //         foreach ($r as $type => $res) {
        //             $subtotal = $res['subtotal']['totalhours'];
        //             $grandtotal['totalhours'] += $subtotal;
        //             $grandtotal['hours'][] = $res['subtotal']['hours'];
        //         }
        //         $array = isset( $grandtotal['hours'] ) ? $grandtotal['hours'] : [];
        //         $keys = array_keys(array_reduce($array, function ($keys, $arr) { return $keys + $arr; }, array()));
        //         $sums = array();
        //         foreach ($keys as $key) {
        //             $sums[$key] = array_reduce($array, function ($sum, $arr) use ($key) { return $sum + @$arr[$key]; });
        //         }
        //         $grandtotal['hours'] = $sums;
        //         $resources = $r;
        //         $calendars = Calendar::whereBetween( 'calendars.datetime', [$start_date, $end_date] )->orderBy('calendars.date', 'ASC')->get();

        //         $employee = Employee::with('detail')->find($id);

        //         $month = date("F", strtotime($month));

        //         $sheet->loadView('Scheduler::files.excel', compact(['resources', 'calendars', 'grandtotal' , 'employee', 'month', 'year']));

        //     });

        // })->download('xls');
    }
}