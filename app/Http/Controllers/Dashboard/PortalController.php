<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortalController extends Controller
{
    public function index(){
        $vendors = Vendor::where('enterprise_id', Auth::user()->ent_id)->paginate(10);
        return view('dashboard.portal.index')->with('vendors',$vendors);
    }
    function fetch_data(Request $request)
    {
     if($request->ajax())
     {

            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $vendors =  Vendor::where('enterprise_id', Auth::user()->ent_id)->where('id', 'like', '%'.$query.'%')
                    ->orWhere('name_ar', 'like', '%'.$query.'%')
                    ->orWhere('name_en', 'like', '%'.$query.'%')
                    ->orderBy('id','desc')->paginate(10);
      return view('dashboard.portal.pagination_data', compact('vendors'));
     }
    }
    public function user_vendor($locale,$id)
    {
        $users = User::whereRoleIs('Vendors')->where('vendor_id',$id)->get();
        return view('dashboard.portal.users', compact('users','id'));
    }
   
    public function updateuser(Request $request)
    {
        $user = User::find($request->id);
        return view('dashboard.portal.update_user', compact('user'));
    }
    public function updateusermodel(Request $request){
        $user = User::find($request->user_id);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return true;

    }
}
