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
        if(request()->header('lang') == null || request()->header('en')){
        $response['status']['message'] = "Unauthorized or Signed in from another device";
        }else{
            $response['status']['message'] = "تم التسجيل من جهاز آخر او من جهاز غير مصرح به";

        }
        return response()->json($response , 200);
      }
    
        
        
        
    
    
}
