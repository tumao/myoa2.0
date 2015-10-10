<?php namespace App\Http\Middleware;

use Closure;

class WebsiteMiddleware
{

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
			if(\Session::has('last_uri'))
			{
				\Session::forget('last_uri');
			}
			$last_uri = trim($_SERVER['REQUEST_URI']);
			\Session::put('last_uri', $last_uri);
			return \Redirect::to('user/load');
		}
		return $next($request);
	}
}