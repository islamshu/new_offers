<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Subscription;
use App\Models\Subscriptions_User;
use Facade\FlareClient\Http\Client;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read-page'])->only('index');
        $this->middleware(['permission:delete-page'])->only('destroy');
  
    }//end of constructor
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_import_to_client()
    {
       $clients = Client::where('type_of_subscribe','PREMIUM')->get();
       $page = Subscription::find(12);
       foreach($clients as $users){
        $user = new Subscriptions_User();
        $user->payment_type = 'new_user';
        $user->expire_date = date('Y-m-d', strtotime((string)$users->expire_date));
        $user->status = 'active';
        $user->balnce = 5;
        $user->purchases_no = $users->purchases_no;
        $user->sub_id = $page->id;
        $user->clinet_id = $users->id;
        $user->country_id = 1;
        $user->save();
       }
       dd('dd');

    }
    public function index()
    {

        return view('dashboard.pages.about')->with('about',About::get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $page = new About();
        $page->title_ar = $request->title_ar;
        $page->title_en = $request->title_en;
        $page->content_ar = $request->content_ar;
        $page->content_en = $request->content_en;
        $page->sort = $request->sort;
        $page->save();
        return redirect()->back()->with(['succss'=>trans('add succeefully')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, About $about)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale,$id)
    {
       $about= About::find($id);
       $about->delete();
       return response()->json(['icon' => 'success', 'title' => 'about deleted successfully'], 200);

    }
}
