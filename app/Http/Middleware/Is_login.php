<?php

namespace App\Http\Middleware;

use Closure;

class Is_login
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
        if (auth('client_api')->check()) {
            return $next($request);
        }
        $response['status']['status'] = false;
        $response['status']['HTTP_code'] = 401;
        $response['status']['HTTP_response'] = 'Unauthorized';
        $response['status']['message'] = "Unauthorized or Signed in from another device";
        return response()->json($response , 401);
      }
    
        
        
        
    
    
}
