<?php


namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Models\Clinet;
use App\Models\Country;
use App\Models\Subscriptions_User;
use Illuminate\Http\Request;

class ClinetController extends Controller
{
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
        $paid = Subscriptions_User::with('subscripe')->whereHas('subscripe', function ($q) {
            $q->where('type_paid','paid');
        })->count();
       
        $non_sub = Clinet::where('uuid_type','null')->count();
        
        return view('dashboard.clinets.first-index',compact('all','trial','paid','non_sub'));
    }
    public function index($locale,$type)
    {

        if($type == 'all'){
            $clinets = Clinet::get();
            $type ='client';

        }elseif($type == 'paid'){
            $clinets = Subscriptions_User::with('subscripe')->whereHas('subscripe', function ($q) {
                $q->where('type_paid','paid');
            })->get();
            $type ='subs';

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
