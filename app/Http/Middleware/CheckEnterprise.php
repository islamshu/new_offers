<?php

namespace App\Http\Middleware;

use App\Models\Enterprise;
use Closure;
use Illuminate\Support\Facades\Redirect;
use Auth;

class CheckEnterprise
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
        if ($request->header('uuid') != null) {
            $enter = Enterprise::where('uuid',$request->header('uuid'))->first();
            if($enter){
                return $next($request);
            }else{
                $response['status']['status'] = false;
                $response['status']['HTTP_code'] = 404;
                $response['status']['HTTP_response'] = 'not found enterprise unkonw uuid';
                return response()->json($response , 200);
            }
        }else{
            $response['status']['status'] = false;
            $response['status']['HTTP_code'] = 404;
            $response['status']['HTTP_response'] = 'Not Found uuid';
            return response()->json($response , 200);  
        }
       
      }
}
