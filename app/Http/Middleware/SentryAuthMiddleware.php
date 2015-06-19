<?php namespace App\Http\Middleware;

use Closure;

class SentryAuthMiddleware {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if(!\Sentry::check())
		{
			return \Redirect::to('admin');
		}
		return $next($request);
	}

}
