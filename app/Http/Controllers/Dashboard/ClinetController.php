<?php


namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Imports\ClientImport;
use App\Models\Clinet;
use App\Models\Country;
use App\Models\Subscriptions_User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Traits\SendNotification;
use App\Models\OfferUser;
use App\Models\Subscription;
use Carbon\Carbon;

class ClinetController extends Controller
{
    use SendNotification;

    
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read-client'])->only('index','first_index');
        $this->middleware(['permission:create-client'])->only('create');
        $this->middleware(['permission:update-client'])->only('edit');
        $this->middleware(['permission:delete-client'])->only('destroy');
  
    }//end of constructor
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function first_index()
    {
        $all = Clinet::count();
        $trial = Subscriptions_User::with('subscripe')->whereHas('subscripe', function ($q) {
            $q->where('type_paid','trial');
        })->count();
        $paid = Clinet::where('type_of_subscribe','PREMIUM')->count();
       
        $non_sub = Clinet::where('uuid_type','null')->count();
        
        return view('dashboard.clinets.first-index',compact('all','trial','paid','non_sub'));
    }
    public function send_notification(Request $request){
        $client = Clinet::find($request->id);
        return view('dashboard.clinets.send_notofication')->with('client',$client);
    }
    public function send_client_notofication(Request $request){
        $client = Clinet::find($request->client_id);
        $token = $client->token;
        $this->notification($token, $request->title, $request->body,  'notofication',null,null);
        return redirect()->back()->with(['success'=>trans('send notification succesffuly')]);

    }
    public function add_sub_to_client(Request $request){
        $client = Clinet::find($request->id);
        $subs = Subscription::where('type_paid','PREMIUM')->get();
        return view('dashboard.clinets.subs')->with('client',$client)->with('subs',$subs);
    }
    public function add_sub_for_user(Request $request){
        $code = Subscription::find($request->sub_id);
        $client = Clinet::find($request->client_id);
        $price = $code->price;
        $user = new Subscriptions_User();
        $user->payment_type = 'admin';
        // dd(auth('client_api')->id());
        $count = Subscriptions_User::where('clinet_id',$client->id)->where('sub_id',$code->id)->count();





        $client->type_of_subscribe = $code->type_paid;
       
        if($code->type_balance == 'Limit'){
            $client->is_unlimited = 0;
            $client->credit= $code->balance;
            $client->remain= $code->balance;
        }elseif($code->type_balance == 'UnLimit'){
            $client->is_unlimited = 1;
            $client->credit=null;
            $client->remain= null;
        }
        if($request->start_date != null && $request->end_date != null){
            $user->expire_date = $request->end_date;
            $client->expire_date = $request->end_date;
            $client->start_date = $request->start_date;
        }else{
            $data_type = $code->expire_date_type;
            $data_type_number = $code->number_of_dayes;
            $client->start_date = Carbon::now();
            if($data_type == 'days'){
                $client->expire_date = Carbon::now()->addDays($data_type_number);
                $user->expire_date = Carbon::now()->addDays($data_type_number);
                
            }elseif($data_type == 'months'){
                $client->expire_date = Carbon::now()->addMonths($data_type_number);
                $user->expire_date = Carbon::now()->addMonths($data_type_number);

            }elseif($data_type == 'years'){
                $client->expire_date = Carbon::now()->addYears($data_type_number);
                $user->expire_date = Carbon::now()->addYears($data_type_number);
            }        
        }
        $user->status = 'active';
        $user->balnce = $code->balance;
        $user->purchases_no =  $count+1;
        $user->sub_id  = $code->id;
        $user->clinet_id  = $client->id;
        $user->save();
        $client->save();
        return redirect()->back()->with(['success'=>'add subscribe succesffuly']);



    }
    public function get_import()
    {
        return view('dashboard.clinets.get_import');
    }
    public function post_import()
    {
        Excel::import(new ClientImport, request()->file('file'));
        return redirect()->back()->with(['success' => 'client Uploded successfully']);
    }
    public function index(Request $request,$locale,$type)
    {
        if($type == 'alluser'){
            
            $query = Clinet::query();
            $query->when($request->regestar_from, function ($q) use ($request) {
                if($request->regestar_from != null && $request->regestar_to != null && $request->regestar_from != $request->regestar_to ){
                    return $q->whereBetween('register_date',[$request->regestar_from. ' 00:00:00.000000',$request->regestar_to. ' 23:59:59.000000']);
                }
                if($request->regestar_from != null && $request->regestar_to == null){
                    return $q->whereBetween('register_date',[$request->regestar_from. ' 00:00:00.000000',Carbon::now()]);
                }
                if($request->regestar_from ==  $request->regestar_to ){
                    return $q->whereBetween('register_date',[$request->regestar_from . ' 00:00:00', $request->regestar_from . ' 23:59:59']);
                }
            });
            $count = $query->count();

        
            $clinets = $query->orderBy('register_date','desc')->paginate(20);
            return view('dashboard.clinets.index',compact('clinets','type','request','count'));

          
        }elseif($type == 'verifyusers'){

            $query = Clinet::query()->where('is_verify',1);
            $query->when($request->regestar_from, function ($q) use ($request) {
                if($request->regestar_from != null && $request->regestar_to != null && $request->regestar_from != $request->regestar_to ){
                    return $q->whereBetween('register_date',[$request->regestar_from. ' 00:00:00.000000',$request->regestar_to. ' 23:59:59.000000']);
                }
                if($request->regestar_from != null && $request->regestar_to == null){
                    return $q->whereBetween('register_date',[$request->regestar_from,Carbon::now()]);
                }
                if($request->regestar_from ==  $request->regestar_to ){
                    return $q->whereBetween('register_date',[$request->regestar_from . ' 00:00:00', $request->regestar_from . ' 23:59:59']);
                }
            });
            
            $count = $query->count();

        
            $clinets = $query->orderBy('register_date','desc')->paginate(20);
            return view('dashboard.clinets.index',compact('clinets','type','request','count'));
        }elseif($type == 'unverifyuser'){
            $query = Clinet::query()->where('is_verify',0);
            $query->when($request->regestar_from, function ($q) use ($request) {
                if($request->regestar_from != null && $request->regestar_to != null && $request->regestar_from != $request->regestar_to ){
                    return $q->whereBetween('register_date',[$request->regestar_from. ' 00:00:00.000000',$request->regestar_to. ' 23:59:59.000000']);
                }
                if($request->regestar_from != null && $request->regestar_to == null){
                    return $q->whereBetween('register_date',[$request->regestar_from,Carbon::now()]);
                }
                if($request->regestar_from ==  $request->regestar_to ){
                    return $q->whereBetween('register_date',[$request->regestar_from . ' 00:00:00', $request->regestar_from . ' 23:59:59']);
                }
            });
          
            $count = $query->count();

        
            $clinets = $query->orderBy('register_date','desc')->paginate(20);
            return view('dashboard.clinets.index',compact('clinets','type','request','count'));
        }elseif($type == 'premiumuser'){
            $query = Clinet::query()->where('type_of_subscribe','PREMIUM')->where('is_verify',1);
            $query->when($request->regestar_from, function ($q) use ($request) {
                if($request->regestar_from != null && $request->regestar_to != null && $request->regestar_from != $request->regestar_to ){
                    return $q->whereBetween('register_date',[$request->regestar_from. ' 00:00:00.000000',$request->regestar_to. ' 23:59:59.000000']);
                }
                if($request->regestar_from != null && $request->regestar_to == null){
                    return $q->whereBetween('register_date',[$request->regestar_from,Carbon::now()]);
                }
                if($request->regestar_from ==  $request->regestar_to ){
                    return $q->whereBetween('register_date',[$request->regestar_from . ' 00:00:00', $request->regestar_from . ' 23:59:59']);
                }
            });
         
            $count = $query->count();

        
            $clinets = $query->orderBy('register_date','desc')->paginate(20);
            return view('dashboard.clinets.index',compact('clinets','type','request','count'));
        }elseif($type == 'trailuser'){      
            $query = Clinet::query()->where('type_of_subscribe','TRIAL')->where('is_verify',1);
            $query->when($request->regestar_from, function ($q) use ($request) {
                if($request->regestar_from != null && $request->regestar_to != null && $request->regestar_from != $request->regestar_to ){
                    return $q->whereBetween('register_date',[$request->regestar_from. ' 00:00:00.000000',$request->regestar_to. ' 23:59:59.000000']);
                }
                if($request->regestar_from != null && $request->regestar_to == null){
                    return $q->whereBetween('register_date',[$request->regestar_from,Carbon::now()]);
                }
                if($request->regestar_from ==  $request->regestar_to ){
                    return $q->whereBetween('register_date',[$request->regestar_from . ' 00:00:00', $request->regestar_from . ' 23:59:59']);
                }
            });
         
            $count = $query->count();

        
            $clinets = $query->orderBy('register_date','desc')->paginate(20);
            return view('dashboard.clinets.index',compact('clinets','type','request','count'));
        }elseif($type == 'none'){
            $query = Clinet::query()->where('type_of_subscribe','FREE')->where('is_verify',1);
            $query->when($request->regestar_from, function ($q) use ($request) {
                if($request->regestar_from != null && $request->regestar_to != null && $request->regestar_from != $request->regestar_to ){
                    return $q->whereBetween('register_date',[$request->regestar_from. ' 00:00:00.000000',$request->regestar_to. ' 23:59:59.000000']);
                }
                if($request->regestar_from != null && $request->regestar_to == null){
                    return $q->whereBetween('register_date',[$request->regestar_from,Carbon::now()]);
                }
                if($request->regestar_from ==  $request->regestar_to ){
                    return $q->whereBetween('register_date',[$request->regestar_from . ' 00:00:00', $request->regestar_from . ' 23:59:59']);
                }
            });
         
            $count = $query->count();

        
            $clinets = $query->orderBy('register_date','desc')->paginate(20);
            return view('dashboard.clinets.index',compact('clinets','type','request','count'));
              }
        

    
    }
    public function ftech_data(Request $request)
    {
        if($request->ajax())
        {

            $type = $request->type;
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            if($type == 'alluser'){

                $queryy =   Clinet::query();
                if($query == null &&  $request->regestar_from == null && $request->regestar_to== null ){

                    $clinets =   $queryy->paginate(20);
                }
                elseif($query == null &&  $request->regestar_from != null && $request->regestar_to != null ){

                $queryy->when($request->regestar_from, function ($q) use ($request,$query) {
                    if($request->regestar_from != null && $request->regestar_to != null && $request->regestar_from != $request->regestar_to ){
                        return $q->whereBetween('register_date',[$request->regestar_from,$request->regestar_to]);
                    }
                    if($request->regestar_from != null && $request->regestar_to == null){
                        return $q->whereBetween('register_date',[$request->regestar_from,Carbon::now()]);
                    }
                    if($request->regestar_from ==  $request->regestar_to ){
                        return $q->whereBetween('register_date',[$request->regestar_from . ' 00:00:00', $request->regestar_from . ' 23:59:59']);
                    }
                });

            }
            elseif($query != null &&  $request->regestar_from == null && $request->regestar_to == null ){

                $queryy->Where('name', 'like', '%'.$query.'%')
              ->orWhere('email', 'like', '%'.$query.'%')
              ->orWhere('phone', 'like', '%'.$query.'%');
            }
            elseif($query != null &&  $request->regestar_from != null && $request->regestar_to != null ){
                $queryy->when($request->regestar_from, function ($q) use ($request,$query)  {
                    if($request->regestar_from != null && $request->regestar_to != null && $request->regestar_from != $request->regestar_to ){
                        return $q->whereBetween('register_date',[$request->regestar_from,$request->regestar_to])
                        ->Where('name', 'like', '%'.$query.'%')
                        ->orWhere('email', 'like', '%'.$query.'%')
                        ->orWhere('phone', 'like', '%'.$query.'%');
                    }
                    if($request->regestar_from != null && $request->regestar_to == null){
                        return $q->whereBetween('register_date',[$request->regestar_from,Carbon::now()])-> Where('name', 'like', '%'.$query.'%')
                        ->orWhere('email', 'like', '%'.$query.'%')
                        ->orWhere('phone', 'like', '%'.$query.'%');
                    }
                    if($request->regestar_from ==  $request->regestar_to ){
                        return $q->whereBetween('register_date',[$request->regestar_from . ' 00:00:00', $request->regestar_from . ' 23:59:59'])-> Where('name', 'like', '%'.$query.'%')
                        ->orWhere('email', 'like', '%'.$query.'%')
                        ->orWhere('phone', 'like', '%'.$query.'%');
                    }
                });
           
            }


                
                $clinets =  $queryy->orderBy('register_date','desc')->paginate(20);  
               
                  
                return view('dashboard.clinets.pagination_data', compact('clinets'));

            }elseif($type == 'verifyusers'){
                $queryy =   Clinet::query()->where('is_verify',1);
                if($query == null &&  $request->regestar_from == null && $request->regestar_to== null ){

                    $clinets =   $queryy->paginate(20);
                }
                elseif($query == null &&  $request->regestar_from != null && $request->regestar_to != null ){

                $queryy->when($request->regestar_from, function ($q) use ($request,$query) {
                    if($request->regestar_from != null && $request->regestar_to != null && $request->regestar_from != $request->regestar_to ){
                        return $q->whereBetween('register_date',[$request->regestar_from,$request->regestar_to]);
                    }
                    if($request->regestar_from != null && $request->regestar_to == null){
                        return $q->whereBetween('register_date',[$request->regestar_from,Carbon::now()]);
                    }
                    if($request->regestar_from ==  $request->regestar_to ){
                        return $q->whereBetween('register_date',[$request->regestar_from . ' 00:00:00', $request->regestar_from . ' 23:59:59']);
                    }
                });

            }
            elseif($query != null &&  $request->regestar_from == null && $request->regestar_to == null ){

                $queryy->Where('name', 'like', '%'.$query.'%')
              ->orWhere('email', 'like', '%'.$query.'%')
              ->orWhere('phone', 'like', '%'.$query.'%');
            }
            elseif($query != null &&  $request->regestar_from != null && $request->regestar_to != null ){
                $queryy->when($request->regestar_from, function ($q) use ($request,$query)  {
                    if($request->regestar_from != null && $request->regestar_to != null && $request->regestar_from != $request->regestar_to ){
                        return $q->whereBetween('register_date',[$request->regestar_from,$request->regestar_to])
                        ->Where('name', 'like', '%'.$query.'%')
                        ->orWhere('email', 'like', '%'.$query.'%')
                        ->orWhere('phone', 'like', '%'.$query.'%');
                    }
                    if($request->regestar_from != null && $request->regestar_to == null){
                        return $q->whereBetween('register_date',[$request->regestar_from,Carbon::now()])-> Where('name', 'like', '%'.$query.'%')
                        ->orWhere('email', 'like', '%'.$query.'%')
                        ->orWhere('phone', 'like', '%'.$query.'%');
                    }
                    if($request->regestar_from ==  $request->regestar_to ){
                        return $q->whereBetween('register_date',[$request->regestar_from . ' 00:00:00', $request->regestar_from . ' 23:59:59'])-> Where('name', 'like', '%'.$query.'%')
                        ->orWhere('email', 'like', '%'.$query.'%')
                        ->orWhere('phone', 'like', '%'.$query.'%');
                    }
                });
           
            }


                
                $clinets =  $queryy->orderBy('register_date','desc')->paginate(20);  
               
                  
                return view('dashboard.clinets.pagination_data', compact('clinets'));

            }elseif($type == 'unverifyuser'){
                $queryy =   Clinet::query()->where('is_verify',0);
                if($query == null &&  $request->regestar_from == null && $request->regestar_to== null ){

                    $clinets =   $queryy->paginate(20);
                }
                elseif($query == null &&  $request->regestar_from != null && $request->regestar_to != null ){

                $queryy->when($request->regestar_from, function ($q) use ($request,$query) {
                    if($request->regestar_from != null && $request->regestar_to != null && $request->regestar_from != $request->regestar_to ){
                        return $q->whereBetween('register_date',[$request->regestar_from,$request->regestar_to]);
                    }
                    if($request->regestar_from != null && $request->regestar_to == null){
                        return $q->whereBetween('register_date',[$request->regestar_from,Carbon::now()]);
                    }
                    if($request->regestar_from ==  $request->regestar_to ){
                        return $q->whereBetween('register_date',[$request->regestar_from . ' 00:00:00', $request->regestar_from . ' 23:59:59']);
                    }
                });

            }
            elseif($query != null &&  $request->regestar_from == null && $request->regestar_to == null ){

                $queryy->Where('name', 'like', '%'.$query.'%')
              ->orWhere('email', 'like', '%'.$query.'%')
              ->orWhere('phone', 'like', '%'.$query.'%');
            }
            elseif($query != null &&  $request->regestar_from != null && $request->regestar_to != null ){
                $queryy->when($request->regestar_from, function ($q) use ($request,$query)  {
                    if($request->regestar_from != null && $request->regestar_to != null && $request->regestar_from != $request->regestar_to ){
                        return $q->whereBetween('register_date',[$request->regestar_from,$request->regestar_to])
                        ->Where('name', 'like', '%'.$query.'%')
                        ->orWhere('email', 'like', '%'.$query.'%')
                        ->orWhere('phone', 'like', '%'.$query.'%');
                    }
                    if($request->regestar_from != null && $request->regestar_to == null){
                        return $q->whereBetween('register_date',[$request->regestar_from,Carbon::now()])-> Where('name', 'like', '%'.$query.'%')
                        ->orWhere('email', 'like', '%'.$query.'%')
                        ->orWhere('phone', 'like', '%'.$query.'%');
                    }
                    if($request->regestar_from ==  $request->regestar_to ){
                        return $q->whereBetween('register_date',[$request->regestar_from . ' 00:00:00', $request->regestar_from . ' 23:59:59'])-> Where('name', 'like', '%'.$query.'%')
                        ->orWhere('email', 'like', '%'.$query.'%')
                        ->orWhere('phone', 'like', '%'.$query.'%');
                    }
                });
           
            }


                
                $clinets =  $queryy->orderBy('register_date','desc')->paginate(20);  
               
                  
                return view('dashboard.clinets.pagination_data', compact('clinets'));

            
            }elseif($type == 'premiumuser'){
                
                $queryy =   Clinet::query()->where('type_of_subscribe','PREMIUM');
                if($query == null &&  $request->regestar_from == null && $request->regestar_to== null ){

                    $clinets =   $queryy->paginate(20);
                }
                elseif($query == null &&  $request->regestar_from != null && $request->regestar_to != null ){

                $queryy->when($request->regestar_from, function ($q) use ($request,$query) {
                    if($request->regestar_from != null && $request->regestar_to != null && $request->regestar_from != $request->regestar_to ){
                        return $q->whereBetween('register_date',[$request->regestar_from,$request->regestar_to]);
                    }
                    if($request->regestar_from != null && $request->regestar_to == null){
                        return $q->whereBetween('register_date',[$request->regestar_from,Carbon::now()]);
                    }
                    if($request->regestar_from ==  $request->regestar_to ){
                        return $q->whereBetween('register_date',[$request->regestar_from . ' 00:00:00', $request->regestar_from . ' 23:59:59']);
                    }
                });

            }
            elseif($query != null &&  $request->regestar_from == null && $request->regestar_to == null ){

                $queryy->Where('name', 'like', '%'.$query.'%')
              ->orWhere('email', 'like', '%'.$query.'%')
              ->orWhere('phone', 'like', '%'.$query.'%');
            }
            elseif($query != null &&  $request->regestar_from != null && $request->regestar_to != null ){
                $queryy->when($request->regestar_from, function ($q) use ($request,$query)  {
                    if($request->regestar_from != null && $request->regestar_to != null && $request->regestar_from != $request->regestar_to ){
                        return $q->whereBetween('register_date',[$request->regestar_from,$request->regestar_to])
                        ->Where('name', 'like', '%'.$query.'%')
                        ->orWhere('email', 'like', '%'.$query.'%')
                        ->orWhere('phone', 'like', '%'.$query.'%');
                    }
                    if($request->regestar_from != null && $request->regestar_to == null){
                        return $q->whereBetween('register_date',[$request->regestar_from,Carbon::now()])-> Where('name', 'like', '%'.$query.'%')
                        ->orWhere('email', 'like', '%'.$query.'%')
                        ->orWhere('phone', 'like', '%'.$query.'%');
                    }
                    if($request->regestar_from ==  $request->regestar_to ){
                        return $q->whereBetween('register_date',[$request->regestar_from . ' 00:00:00', $request->regestar_from . ' 23:59:59'])-> Where('name', 'like', '%'.$query.'%')
                        ->orWhere('email', 'like', '%'.$query.'%')
                        ->orWhere('phone', 'like', '%'.$query.'%');
                    }
                });
           
            }


                
                $clinets =  $queryy->orderBy('register_date','desc')->paginate(20);  
               
                  
                return view('dashboard.clinets.pagination_data', compact('clinets'));

            }elseif($type == 'trailuser'){
                $queryy =   Clinet::query()->where('type_of_subscribe','TRIAL');
                if($query == null &&  $request->regestar_from == null && $request->regestar_to== null ){

                    $clinets =   $queryy->paginate(20);
                }
                elseif($query == null &&  $request->regestar_from != null && $request->regestar_to != null ){

                $queryy->when($request->regestar_from, function ($q) use ($request,$query) {
                    if($request->regestar_from != null && $request->regestar_to != null && $request->regestar_from != $request->regestar_to ){
                        return $q->whereBetween('register_date',[$request->regestar_from,$request->regestar_to]);
                    }
                    if($request->regestar_from != null && $request->regestar_to == null){
                        return $q->whereBetween('register_date',[$request->regestar_from,Carbon::now()]);
                    }
                    if($request->regestar_from ==  $request->regestar_to ){
                        return $q->whereBetween('register_date',[$request->regestar_from . ' 00:00:00', $request->regestar_from . ' 23:59:59']);
                    }
                });

            }
            elseif($query != null &&  $request->regestar_from == null && $request->regestar_to == null ){

                $queryy->Where('name', 'like', '%'.$query.'%')
              ->orWhere('email', 'like', '%'.$query.'%')
              ->orWhere('phone', 'like', '%'.$query.'%');
            }
            elseif($query != null &&  $request->regestar_from != null && $request->regestar_to != null ){
                $queryy->when($request->regestar_from, function ($q) use ($request,$query)  {
                    if($request->regestar_from != null && $request->regestar_to != null && $request->regestar_from != $request->regestar_to ){
                        return $q->whereBetween('register_date',[$request->regestar_from,$request->regestar_to])
                        ->Where('name', 'like', '%'.$query.'%')
                        ->orWhere('email', 'like', '%'.$query.'%')
                        ->orWhere('phone', 'like', '%'.$query.'%');
                    }
                    if($request->regestar_from != null && $request->regestar_to == null){
                        return $q->whereBetween('register_date',[$request->regestar_from,Carbon::now()])-> Where('name', 'like', '%'.$query.'%')
                        ->orWhere('email', 'like', '%'.$query.'%')
                        ->orWhere('phone', 'like', '%'.$query.'%');
                    }
                    if($request->regestar_from ==  $request->regestar_to ){
                        return $q->whereBetween('register_date',[$request->regestar_from . ' 00:00:00', $request->regestar_from . ' 23:59:59'])-> Where('name', 'like', '%'.$query.'%')
                        ->orWhere('email', 'like', '%'.$query.'%')
                        ->orWhere('phone', 'like', '%'.$query.'%');
                    }
                });
           
            }


                
                $clinets =  $queryy->orderBy('register_date','desc')->paginate(20);  
               
                  
                return view('dashboard.clinets.pagination_data', compact('clinets'));

            }elseif($type == 'none'){
        
                         
                $queryy =   Clinet::query()->where('type_of_subscribe','FREE');
                if($query == null &&  $request->regestar_from == null && $request->regestar_to== null ){
                    $clinets =   $queryy->paginate(20);
                }
                elseif($query == null &&  $request->regestar_from != null && $request->regestar_to != null ){

                $queryy->when($request->regestar_from, function ($q) use ($request,$query) {
                    if($request->regestar_from != null && $request->regestar_to != null && $request->regestar_from != $request->regestar_to ){
                        return $q->whereBetween('register_date',[$request->regestar_from,$request->regestar_to]);
                    }
                    if($request->regestar_from != null && $request->regestar_to == null){
                        return $q->whereBetween('register_date',[$request->regestar_from,Carbon::now()]);
                    }
                    if($request->regestar_from ==  $request->regestar_to ){
                        return $q->whereBetween('register_date',[$request->regestar_from . ' 00:00:00', $request->regestar_from . ' 23:59:59']);
                    }
                });

            }
            elseif($query != null &&  $request->regestar_from == null && $request->regestar_to == null ){

                $queryy->Where('name', 'like', '%'.$query.'%')
              ->orWhere('email', 'like', '%'.$query.'%')
              ->orWhere('phone', 'like', '%'.$query.'%');
            }
            elseif($query != null &&  $request->regestar_from != null && $request->regestar_to != null ){

                $queryy->when($request->regestar_from, function ($q) use ($request,$query)  {
                    if($request->regestar_from != null && $request->regestar_to != null && $request->regestar_from != $request->regestar_to ){
                        return $q->whereBetween('register_date',[$request->regestar_from,$request->regestar_to])-> Where('name', 'like', '%'.$query.'%')
                        ->orWhere('email', 'like', '%'.$query.'%')
                        ->orWhere('phone', 'like', '%'.$query.'%');
                    }
                    if($request->regestar_from != null && $request->regestar_to == null){
                        return $q->whereBetween('register_date',[$request->regestar_from,Carbon::now()])-> Where('name', 'like', '%'.$query.'%')
                        ->orWhere('email', 'like', '%'.$query.'%')
                        ->orWhere('phone', 'like', '%'.$query.'%');
                    }
                    if($request->regestar_from ==  $request->regestar_to ){
                        return $q->whereBetween('register_date',[$request->regestar_from . ' 00:00:00', $request->regestar_from . ' 23:59:59'])-> Where('name', 'like', '%'.$query.'%')
                        ->orWhere('email', 'like', '%'.$query.'%')
                        ->orWhere('phone', 'like', '%'.$query.'%');
                    }
                });
           
            }


                
                $clinets =  $queryy->orderBy('register_date','desc')->paginate(20);  
                return view('dashboard.clinets.pagination_data', compact('clinets'));

            }
            
              
        }
    }


    public function create()
    {
        $countries = Country::get(); 
        return view('dashboard.clinets.create',compact('countries'));
    }


    public function store(Request $request)
    {
        //
    }


    public function show($locale,$id)
    {
        
      $member =   Clinet::find($id);
    //   dd($member);
    // dd($member);
      return view('dashboard.clinets.show')->with('member',$member);
    }
    public function get_reedem_for_user($locale,$user_id,$sub_id)
    {
        $offers = OfferUser::where('sub_id',$sub_id)->where('client_id',$user_id)->get();
        $client = Clinet::find($user_id);
        return view('dashboard.clinets.reedeem')->with('offers',$offers)->with('client',$client);
        return $offers;
    }
    public function deletesub($lang,$id)
    {
        $sub = Subscriptions_User::find($id);

      

        $client = Clinet::find($sub->clinet_id);
        $code = Subscription::where('id',$sub->sub_id)->first();
        
  
        $subs = Subscriptions_User::where('id','!=',$id)->where('clinet_id',$sub->clinet_id)->where('expire_date','>',Carbon::now())->first();
        if($subs){
            $client->type_of_subscribe = $code->type_paid;
            $count = OfferUser::where('sub_id',$subs->id)->where('client_id',$client->id)->count();
            if ($code->type_balance == 'Limit') {
                $client->is_unlimited = 0;
                $client->credit = $code->balance   ;
                $client->remain = $code->balance - $count;
            } elseif ($code->type_balance == 'UnLimit') {
                $client->is_unlimited = 1;
                $client->credit = null;
                $client->remain = null;
            }
            $client->expire_date = $subs->expire_date;
            $client->start_date = $subs->created_at;
            $client->save();
        }else{
            $client->is_unlimited = 0;
            $client->credit = null;
            $client->remain = null;
            $client->type_of_subscribe = 'FREE';
            $client->expire_date = null;
            $client->start_date = null;
            $client->save();
        }
        $sub->delete();
        return redirect()->back();
    }


    public function edit(Clinet $clinet)
    {
        //
    }

    public function update(Request $request, Clinet $clinet)
    {
        //
    }

  
    public function destroy(Clinet $clinet)
    {
        //
    }
}
