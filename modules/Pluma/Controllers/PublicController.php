<?php
namespace Pluma\Controllers;

use Pluma\Controllers\PublicController;
use Illuminate\Http\Request;

class PublicController extends Controller
{
	protected $homeSlug = 'home';

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('Pluma::public.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  string  $slug
	 * @return \Illuminate\Http\Response
	 */
	public function show( $slug = "" )
	{
		if ( "" == $slug ) $slug = $this->homeSlug;

		$modules = config('modules.enabled');

		foreach ( $modules as $module ) {
			if ( view()->exists("$module::static.$slug") ) return view("$module::static.$slug");
		}

		dd($slug);
		return view('Pluma::public.show');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		dd('public controller');
	}
}