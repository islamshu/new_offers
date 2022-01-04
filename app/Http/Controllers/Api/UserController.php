<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\UserResoures;
use App\Models\User;

class UserController extends BaseController
{
    public  function login(Request $request,$ent_id)
    {
        $user = User::where('phone',$request->phone)->first();
        if($user){
            $res['status']= $this->sendResponse('Old');
            // $res['data']['client'] = new UserResoures($user);
            // $res['token'] = $user->createToken('Personal Access Token')->accessToken;
                // $res['data']['client'] = new UserResoures($user);
            // $res['token'] = $user->createToken('Personal Access Token')->token;
            $res['data'][""]="";
            $res['other']['exist_status']= 'old';
            $res['other']['for']= 'login';



        }else{
            $user = new User();
            $user->phone = $request->phone;
            $user->code = 1991;
            $user->image = 'default.jpeg';
            $user->country_id = $request->country_id;
            $user->save();
            $res['status']= $this->sendResponse('Created');
            // $res['data']['client'] = new UserResoures($user);
            // $res['token'] = $user->createToken('Personal Access Token')->token;
            $res['data'][""]="";
            $res['other']['exist_status']= 'NEW';
            $res['other']['for']= 'signup';
        }
        return $res;
    }
    public function verification_code(Request $request){
        $user = User::where('phone',$request->phone)->where('code',$request->verification_code)->first();
        if($user){
            $res['status']= $this->sendResponse('OK');
            // $res['data']['client'] = new UserResoures($user);
            $res['token'] = $user->createToken('Personal Access Token')->accessToken;
            $res['data']['client'] = new UserResoures($user);
            // $res['token'] = $user->createToken('Personal Access Token')->token;
            // $res['data'][""]="";
            $res['other']['is_trial_subscriber']= '';
            return $res;
        }else{
            $res['status']=$this->sendError();
            return  $res;
        }
    }
    public function user_info()
    {
        $user = auth()->user();
        $res['status']= $this->sendResponse('OK');
        $res['data']['client'] = new UserResoures($user);
        return $res;
    }
}
