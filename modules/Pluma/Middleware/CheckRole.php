<?php
namespace Pluma\Middleware;

use Pluma\Support\Traits\RouteRole;
use Closure;

class CheckRole
{
	use RouteRole;

	/**
	 * Array of roles.
	 * @var array
	 */
	protected $roles;

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @param  roles
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$this->roles = $this->roles($request);

		$actions = $request->route()->getAction();
		$request->route()->setAction( $actions + ['roles' => $this->roles] );

		// check if user has the role specified in the route
		if ( $request->user() && $request->user()->hasRole( $this->roles ) ) {
			return $next( $request );
		}

		return response()->view("Pluma::errors.403", [
				'error' => [
					'code' => 'INSUFFICIENT_PERMISSION',
					'description' => 'You are not authorized to access this resource.',
				]
			], 403);
	}
}