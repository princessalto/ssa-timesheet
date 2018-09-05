<?php
namespace Pluma\Controllers;

use Pluma\Controllers\Controller as BaseController;

class DashboardController extends BaseController
{

	public function __construct()
	{
		$this->middleware( ['web', 'auth.admin'] );
	}

	public function index()
	{
		return view('Pluma::dashboard.index');
	}


	public function subtotalCount()
	{
		$billableCount = Scheduler::count();
		$nonbillableCount = Scheduler::count();
	}


}