<?php
 
namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller as Controller;

class BaseController extends Controller  
{

    public function sendResponse($status){   
        $response = ['status' => true ,'HTTP_code'=>201,'HTTP_response'=>$status];
        return $response;    }

        public function SendError( $code = 404){
            $response = ['status' => false,'HTTP_code'=>404,'HTTP_response'=>'Not Found'];
     
            return $response;
        }
    public function UnAuth( $code = 404){
        $response = ['status' => false,'HTTP_code'=>404,'HTTP_response'=>'Unauthorized', 'message' => 'Unauthorized or Signed in from another device'];
 
        return $response;
    }
}