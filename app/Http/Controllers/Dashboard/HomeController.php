<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Clinet;
use App\Models\Subscriptions_User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Session;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function all_user_not_sub()
    {
       $users = Clinet::where('type_of_subscribe','TRIAL')->get();
       $array= [];
       foreach($users as $us){
      $is_user=  Subscriptions_User::where('clinet_id',$us->id)->first();
      if(!$is_user){
        array_push($array,$us->id);
      }    
       }
       dd($array);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
   
    function lang(Request $request,$local){
        $url = url()->previous();
        $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();
        
       
        Session::put('lang', $local);
        
        return redirect(url($local.'/home'));

        
        return redirect()->route($route,$local);
    }

    public function show_translate($local,$lang)
    {
        $language = $lang;
        
        return view('languages.language_view_en', compact('language'));
    }
    public function key_value_store(Request $request)
    {
        $data = openJSONFile($request->id);
        foreach ($request->key as $key => $key) {
            $data[$key] = $request->key[$key];
        }
        saveJSONFile($request->id, $data);
        return back();
    }

}
