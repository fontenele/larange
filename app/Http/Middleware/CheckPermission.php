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
            return response(json_encode(['message' => 'Você não possui permissão.']), 401);
        }
        
        if(!$permission || $user->hasPermission($permission)) {
            return $next($request);
        }

        return response(json_encode(['message' => 'Você não possui permissão.']), 401);
	}

}
