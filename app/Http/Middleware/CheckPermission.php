<?php namespace App\Http\Middleware;

use Closure;

class CheckPermission {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next, $permission = null) {
        if(($user = \Session::get('user')) == null) {
            return response('Você não possui permissão para visualizar essa página.', 401);
        }
        
        if(!$permission || $user->hasPermission($permission)) {
            return $next($request);
        }

        return response('Você não possui permissão para visualizar essa página.', 401);
	}

}
