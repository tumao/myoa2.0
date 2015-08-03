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
		$User = \Session::get('currentUser');
		if($User->hasAccess('user.notLoadAdmin'))		//如果用户不被允许登录后台
		{
			\Sentry::logout();
			return \Redirect::to('/');
		}
		return $next($request);
	}

}
