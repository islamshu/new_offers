<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\ClientResoures;
use App\Http\Resources\UserResoures;
use App\Models\City;
use App\Models\Clinet;
use App\Models\Enterprise;
use App\Models\Offer;
use App\Models\User;
use Carbon\Carbon;

class UserController extends BaseController
{
    public  function login(Request $request)
    {
        $user = Clinet::where('phone',$request->phone)->first();
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
            $user = new Clinet();
            $user->phone = $request->phone;
            $user->code = 1991;
            $user->image = 'default.jpeg';
            $user->country_id = $request->country_id;
            $uuid = 'jooy';
            $enter = Enterprise::where('uuid',$uuid)->first();
            if($enter){
            $user->uuid_type =  'enterprise';
            $user->enterprise_id = $enter->id;
            }else{
                $res['status']=$this->sendError();
                $res['meessage'] = 'not found enterprise unkonw uuid';
                return  $res;
            }
            // if(!$enter){
            //     $ee = Offer::where('uuid',$uuid)->first();
            //     if($ee){
            //         $user->uuid_type =  'offer';
            //         $user->offer_id = $ee->id;  
            //     }
            // }else{
            //     $user->uuid_type =  'null';
            // }
            // dd($uuid);

            
            $user->save();
            $res['status']= $this->sendResponse('Created');

            $res['data']['client'] = new ClientResoures($user);

            $res['token'] = $user->createToken('Personal Access Token')->token;
            $res['data'][""]="";
            $res['other']['exist_status']= 'NEW';
            $res['other']['for']= 'signup';
        }
        return $res;
    }
    public function update(Request $request){
        $user = auth('client_api')->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->nationality = $request->nationality;
        $user->gender = $request->gender;
        $user->birth_date = $request->birth_date;
        $user->save();
        $res['status']= $this->sendResponse('OK');
        $res['data'][""] = "";

        return $res;
    }
    public function verification_code(Request $request){
        $user = Clinet::where('phone',$request->phone)->where('code',$request->verification_code)->first();
        // dd($user);
        if($user){
            $user->last_login = Carbon::now();
            $user->save();
            $res['status']= $this->sendResponse('OK');
            // $res['data']['client'] = new UserResoures($user);
            $res['data']['token'] = $user->createToken('Personal Access Token')->accessToken;
            $res['data']['client'] = new ClientResoures($user);
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
        $user = auth('client_api')->user();
       
        $res['status']= $this->sendResponse('OK');
        $res['data']['client'] = new ClientResoures($user);
        return $res;
    }
    public function update_image(Request $request){
        $user = auth('client_api')->user();
        $user->image = $request->image->store('client/image');
        $user->save();
        $res['status']= $this->sendResponse('OK');
        $res['data'][""] = "";
        return $res;
    }
    public function update_city(Request $request){
        $user = auth('client_api')->user();
        $city = City::find($request->city_id);
        if(!$city){
            $res['status']=$this->sendError();
            $res['message']= 'city not found';
            return  $res;
        }
        $user->city_id = $request->city_id;
        $user->save();
        $res['status']= $this->sendResponse('OK');
        $res['data'][""] = "";
        return $res;
    }
}
