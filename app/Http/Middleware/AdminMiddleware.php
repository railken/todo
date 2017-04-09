<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
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

		if ($request->user()->role != 'admin') {
			abort(401);
		}

		return $next($request);
	}
}
