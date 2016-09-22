<?php namespace App\Http\Middleware;

use Closure;

class CheckRole {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
        if(\Session::get('user') == null) {
            return response('Unauthorized.', 401);
        }
        $actions = $request->route()->getAction();
        $roles = isset($actions['roles']) ? $actions['roles'] : null;
        if(!$roles || \Session::get('user')->hasAnyRole($roles)) {
    		return $next($request);
        }
        return response('Unauthorized.', 401);
	}

}
