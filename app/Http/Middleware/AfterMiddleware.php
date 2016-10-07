<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class AfterMiddleware {

    public function handle($request, Closure $next) {
        $response = $next($request);
        $content = $response->getOriginalContent();
//        $user = \Session::get('user');
        
        $content['__sys__']['totals'] = [
            'messages' => 0,
            'notifications' => 0,
            'tasks' => 0,
        ];
        $response->setContent($content);
        return $response;
    }

}