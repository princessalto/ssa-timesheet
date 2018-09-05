<?php

namespace Pluma\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectToDashboardIfAuthenticated
{
	protected $redirectPath = '/admin/dashboard';

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @param  string|null  $guard
	 * @return mixed
	 */
	public function handle($request, Closure $next, $guard = null)
	{
		if (Auth::guard($guard)->check()) {
			return redirect( $this->redirectPath );
		}

		return $next($request);
	}
}
