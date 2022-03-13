<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\ClientPaidResourse;
use App\Http\Resources\ClientResoures;
use App\Http\Resources\ClientTwoResoures;
use App\Http\Resources\SubResoures;
use App\Http\Resources\TransactionCollection;
use App\Http\Resources\UserResoures;
use App\Http\Resources\UserSubscription;
use App\Models\City;
use App\Models\Clinet;
use App\Models\Enterprise;
use App\Models\Offer;
use App\Models\Subscription;
use App\Models\Subscriptions_User;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;

class UserController extends BaseController
{
    public  function login(Request $request)
    {
        $user = Clinet::where('phone',$request->phone)->first();
        if($user){
            $user->code = rand(1111,9999);
            $user->save();
            $res['status']= $this->sendResponse('Created');
            // $res['data']['client'] = new UserResoures($user);
            // $res['token'] = $user->createToken('Personal Access Token')->accessToken;
                // $res['data']['client'] = new UserResoures($user);
            // $res['token'] = $user->createToken('Personal Access Token')->token;
            if($user->is_verify == 1){

            
            $res['data'][""]="";
            $res['other']['exist_status']= 'EXIST';
            $res['other']['for']= 'login';
            }else{
                $res['data'][""]="";
                $res['other']['exist_status']= 'NON-VERIFIED';
                $res['other']['for']= 'signup';  
            }
            if(get_general('actvie_sms') == '1'){
                // if(request()->header('lang') == null || request()->header('lang') == 'en' ){

                //     $message = 'welcome to Jooy offers Your activation code is: '.$user->code.' #jooy received it';
    
                // }else{
                //     $message = 'أهلا بك فى جووي كود التفعيل الخاص بك هو : '.$user->code.' #جووي تلقاه';
       
                // }
                $message = 'أهلا بك فى جووي كود التفعيل الخاص بك هو : '.$user->code.' #جووي تلقاه';

                send_message($user->phone,$message );
            }


        }else{
            $code = Subscription::where('type_paid','TRIAL')->where('status',1)->where('end_date','>=',Carbon::now())->first();
            $userr = new Clinet();
            $userr->phone = $request->phone;
            $userr->code = rand(1111,9999);
            $userr->image = 'default.jpeg';
            $userr->country_id = 1;
            $userr->type_of_subscribe = 'TRIAL';
            $uuid = 'jooy';
            $enter = Enterprise::where('uuid',$uuid)->first();
            if($enter){
            $userr->uuid_type =  'enterprise';
            $userr->enterprise_id = $enter->id;
           
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

          
            $userr->save();
            $user = new Subscriptions_User();
            $user->payment_type = 'new_user';
            // dd(auth('client_api')->id());
            $userr->is_trial = 1;
            $userr->save();

            $userr->type_of_subscribe = $code->type_paid;
    
            if ($code->type_balance == 'Limit') {
                $userr->is_unlimited = 0;
                $userr->credit = $code->balance;
                $userr->remain = $code->balance;
            } elseif ($code->type_balance == 'UnLimit') {
                $userr->is_unlimited = 1;
                $userr->credit = null;
                $userr->remain = null;
            }
            $userr->start_date = Carbon::now();
            $data_type = $code->expire_date_type;
            if( $code->type_paid=='TRIAL'){
                $data_type_number = $code->days_of_trial;

            }else{
                $data_type_number = $code->days_of_trial;
            }
            if ($data_type == 'days') {
                $userr->expire_date = Carbon::now()->addDays($data_type_number);
            } elseif ($data_type == 'months') {
                $userr->expire_date = Carbon::now()->addMonths($data_type_number);
            } elseif ($data_type == 'years') {
                $userr->expire_date = Carbon::now()->addYears($data_type_number);
            }
            $userr->save();
    
            if ($data_type == 'days') {
                $user->expire_date = Carbon::now()->addDays($data_type_number);
            } elseif ($data_type == 'months') {
                $user->expire_date = Carbon::now()->addMonths($data_type_number);
            } elseif ($data_type == 'years') {
                $user->expire_date = Carbon::now()->addYears($data_type_number);
            }
            $user->status = 'active';
            $user->balnce = $code->balance;
            $user->purchases_no =  1;
            $user->sub_id  = $code->id;
            $user->clinet_id  = $userr->id;
            $user->save();
            
            if(get_general('actvie_sms') == '1'){
                if(request()->header('lang') == null || request()->header('lang') == 'en' ){

                    $message = 'welcome to Jooy offers Your activation code is: '.$user->code.' #jooy received it';
    
                }else{
                    $message = 'أهلا بك فى جووي كود التفعيل الخاص بك هو : '.$user->code.' #جووي تلقاه';
       
                }
                send_message($user->phone,$message );
            }
            $res['status']= $this->sendResponse('Created');

            // $res['data']['client'] = new ClientResoures($user);

            // $res['token'] = $user->createToken('Personal Access Token')->token;
            $res['data'][""]="";
            $res['other']['exist_status']= 'NEW';
            $res['other']['for']= 'signup';
        }
        return $res;
    }
    public function resend_sms(Request $request){
        $phone = $request->phone;
        $user = Clinet::where('phone',$phone)->first();
        
        // $user = Clinet::where('phone',$phone)->first();
        // dd($user);
        // $user->code = 1991;
        // $user->save();

        // if(request()->header('lang') == null || request()->header('lang') == 'en' ){

        //     $message = 'welcome to Jooy offers Your activation code is: '.$user->code.' #jooy received it';

        // }else{
        //     $message = 'أهلا بك فى جووي كود التفعيل الخاص بك هو : '.$user->code.' #جووي تلقاه';

        // }
        if(get_general('actvie_sms') == '1'){
            send_message($request->phone,$message );
        }
        $res['status']= $this->sendResponse('Created');

        // $res['data']['client'] = new ClientResoures($user);

        // $res['token'] = $user->createToken('Personal Access Token')->token;
        $res['data'][""]="";
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
        $res['status']= $this->sendResponse200('OK');
        if($user->type_of_subscribe == null || $user->type_of_subscribe == 'Free'){
            $res['data']['client'] =  new ClientResoures($user);

        }
        $res['data']['client'] = new ClientPaidResourse($user);



        return $res;
    }
    public function verification_code(Request $request){
    
        $user = Clinet::where('phone',$request->phone)->where('code',$request->verification_code)->first();
        // dd($user);
        if($user){
           
            $user->last_login = Carbon::now();
            $user->is_verify = 1;
            $user->save();
            $res['status']= $this->sendResponse200('OK');
            // $res['data']['client'] = new UserResoures($user);
            $res['data']['client'] = new ClientResoures($user);
            // $res['data']['token'] = $user->createToken('Personal Access Token')->accessToken;

            // $res['token'] = $user->createToken('Personal Access Token')->token;
            // $res['data'][""]="";
          
            if(Carbon::now() > $user->expire_date ){
                $user->is_trial =0;
                $user->type_of_subscribe ='FREE';
                $user->save();
            }
            if($user->is_trial == 1){
                $res['other']['is_trial_subscriber']= true;
            }else{
                $res['other']['is_trial_subscriber']= false;
 
            }
            return $res;
        }else{
            $res['status']=$this->sendError();
            return  $res;
        }
    }
    public function user_info()
    {
      

        $user = auth('client_api')->user();
       
       
        $res['status']= $this->sendResponse200('OK');
        if($user->type_of_subscribe == null || $user->type_of_subscribe == 'Free'){
            $res['data']['client'] =  new ClientResoures($user);
            $res['other']['is_trial_subscriber']= false;

        }
        $res['data']['client'] = new ClientPaidResourse($user);
        return $res;
    }
    public function register_token(Request $request)
    {
      

        $user = auth('client_api')->user();
        $user->token = $request->registration_id;
        $user->save();
       
        $res['status']= $this->sendResponse('Created');
        $res['data']['data'][''] ="" ;

        return $res;
    }
    public function current_subscription(){
        $user = auth('client_api')->user();
        
       
        $res['status']= $this->sendResponse200('ok');
        $sub = Subscriptions_User::where('clinet_id',$user->id)->orderBy('id','desc')->first();
        
        $res['data']['client_subscription'] =new UserSubscription($sub);

        return $res;
    }
    public function update_image(Request $request){
        $user = auth('client_api')->user();
        $user->image = $request->image->store('client/image');
        $user->save();
        $res['status']= $this->sendResponse200('OK');
        if($user->type_of_subscribe == null || $user->type_of_subscribe == 'Free'){
            $res['data']['client'] =  new ClientResoures($user);
        }
        $res['data']['client'] = new ClientPaidResourse($user);
        return $res;
    }
    public function transactions(Request $request)
    {
        $page = $request->has('page') ? $request->get('page') : 1;
        $limit = $request->has('paginate') ? $request->get('paginate') : 10;
        $trans = Transaction::where('client_id',auth('')->id())->orderBy('id','desc')->limit($limit)->offset(($page - 1) * $limit)->get();
        $res['status']= $this->sendResponse200('OK');
        // $trans =
      
        $res['data']['transactions'] = new TransactionCollection($trans);
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
        $res['status']= $this->sendResponse200('OK');
        if($user->type_of_subscribe == null || $user->type_of_subscribe == 'Free'){
            $res['data']['client'] =  new ClientResoures($user);

        }
        $res['data']['client'] = new ClientPaidResourse($user);
        return $res;
    }
    public function logout() {
        // dd
       $user = auth('client_api')->user();
       $user->tokens->each(function($token, $key) {
      
            $token->delete();
        });
        $user->token = null;
        $user->save();
        $res['status']= $this->sendResponse200('OK');
        $res['data']['']="";


    
        return $res;
    }
}
