<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\GeneralNotofication;
use App\Models\Offer;
use App\Models\User;
use App\Models\Vendor;
use Notification;
use App\Notifications\UserNotification;
use Illuminate\Http\Request;

class GeneralNotoficationController extends Controller
{
    public function index(){
        return view('dashboard.notofication.general')->with('notofications',GeneralNotofication::with(['vendor','offer'])->get());
    }
    public function create(){
        $vendors = Vendor::where('enterprise_id',auth()->user()->ent_id)->get();
       
        $notofications=GeneralNotofication::get();
        return view('dashboard.notofication.general_create',compact('vendors','notofications'));
    }
    public function get_offer($locale,$id){
        $offers = Offer::with('vendor')->where('vendor_id',$id)->get();
    }
    public function store(Request $request ,$locale){
        $not = new GeneralNotofication();
        $not->title_en = $request->title_en;
        $not->title_ar = $request->title_ar;
        $not->body_en = $request->body_en;
        $not->body_ar = $request->body_ar;
        $not->vendor_id = $request->vendor_id;
        $not->offer_id = $request->offer_id;

        $not->save();
        return response()->json(['icon' => 'success', 'title' => 'Notofication created successfully'], $not ? 200 : 400);
    }
    public function create_user_notofication(){
        $users = User::get();
        return view('dashboard.notofication.user_create',compact('users'));
    }
    public function store_user_notofication(Request $request , $locale)
    {
        $date =[
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'body_ar' => $request->body_ar,
            'body_en' => $request->body_en,
        ];
        $user = User::find($request->user_id);
        Notification::send($user, new UserNotification($date));
        $not = 'true';
        return response()->json(['icon' => 'success', 'title' => 'Notofication send successfully'], $not ? 200 : 400);

        
    }
}
