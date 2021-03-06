<?php

namespace App\Http\Controllers;

use App\Models\GeneralInfo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class GeneralInfoController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:update-config'])->only(['config','firebase','index','myfatoorah']);
    
  
    }//end of constructor
    public function config()
    {
        return view('dashboard.generalinfo.config');
    }
    public function firebase()
    {
        return view('dashboard.generalinfo.firebase');
    }
    public function index()
    {

        $token = get_general('sms_token');
        $sender = get_general('sender_id') ;
        $message ='تجربة';
        
        
      $url = 'https://api.oursms.com/api-a/msgs?token='.$token.'&src='.$sender.'&dests=966548102240&body='.$message;
      $userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:97.0) Gecko/20100101 Firefox/97.0';
    
      $response = Http::withHeaders(['User-Agent' => $userAgent])->get($url);
    //   dd($response);
    //   return true;
    
      

        $token = get_general('sms_token');
        $agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36';

        $response = Http::withUserAgent(request()->userAgent())->get('https://api.oursms.com/api-a/billing/credits?token=whyfA4pML1nN4w3Yj7_WpKDo29NIOWav-0EqK38KRco');
        // dd($response);
        // dd($response , request()->getHttpHost());
        // return redirect()->route('get_cridit');
        return view('dashboard.generalinfo.index');

    }
    public function myfatoorah()
    {
        return view('dashboard.generalinfo.myfatoorah');
    }



    public function store(Request $request)
    {
        if ($request->hasFile('general_file')) {
            foreach ($request->file('general_file') as $name => $value) {
                if ($value == null) {
                    continue;
                }
                Generalinfo::setValue($name, $value->store('general'));
            }
        }

        foreach ($request->input('general') as $name => $value) {
            if ($value == null) {
                continue;
            }
            Generalinfo::setValue($name, $value);
        }

        session()->flash('success', 'تم تحديث البيانات بنجاح');
        return redirect()->back();
    }
}
