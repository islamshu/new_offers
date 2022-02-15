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
use App\Models\Subscription;
use Facade\FlareClient\Http\Client;

class ClinetController extends Controller
{
    use SendNotification;

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
        $this->notification($token,  $request->body, $request->title, 'notofication');
        return redirect()->back()->with(['success'=>trans('send notification succesffuly')]);

    }
    public function add_sub_to_client(Request $request){
        $client = Clinet::find($request->id);
        $subs = Subscription::where('type_paid','PREMIUM')->get();
        return view('dashboard.clinets.subs')->with('client',$client)->with('subs',$subs);

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
    public function index($locale,$type)
    {

        if($type == 'all'){
            $clinets = Clinet::get();
            $type ='client';

        }elseif($type == 'premium'){
            $clinets =   Clinet::where('type_of_subscribe','PREMIUM')->get();
              
            $type ='client';

        }elseif($type == 'trail'){
            
            $clinets = Subscriptions_User::with('subscripe')->whereHas('subscripe', function ($q) {
                $q->where('type_paid','trial');
            })->get();
            $type ='subs';

        }elseif($type == 'none'){
            $clinets =   Clinet::where('uuid_type','null')->get();
            $type ='client';

        }
        return view('dashboard.clinets.index',compact('clinets','type'));

    
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
