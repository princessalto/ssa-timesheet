<?php
namespace Pluma\Controllers;

use Pluma\Controllers\Controller;
use Illuminate\Http\Request;
use Pluma\Models\Settings;

class SettingsController extends Controller
{

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getGeneralForm()
	{
		$settings = Settings::all();
		return view("Pluma::settings.general")->with( compact('settings') );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getProfileForm()
	{
		return view("Pluma::settings.profile");
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function general(Request $request)
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function profile(Request $request)
	{
		//
	}
}