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
            return response('Unauthorized.', 401);
        }
        
        if(!$permission || $user->hasPermission($permission)) {
            return $next($request);
        }

        return response('Unauthorized.', 401);
//	    dd($user->hasPermission($permission), $permission, $user);
//        
//        
//        
//        
//        
//        
//        $actions = $request->route()->getAction();
//        $permissions = isset($actions['permissions']) ? $actions['permissions'] : null;
//        dd($permissions);
//        if(!$roles || \Session::get('user')->hasAnyRole($roles)) {
//    		return $next($request);
//        }
//        return response('Unauthorized.', 401);
	}

}
