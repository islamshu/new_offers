<?php

namespace App\Http\Controllers;

use App\Models\GeneralInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GeneralInfoController extends Controller
{
    public function config(){
        return view('dashboard.generalinfo.config'); 
    }
    public function firebase()
    {
        return view('dashboard.generalinfo.firebase');
    }
    public function index()
    {
        $token = get_general('sms_token');
       $url= 'https://api.oursms.com/api-a/billing/credits?token=whyfA4pML1nN4w3Yj7_WpKDo29NIOWav-0EqK38KRco';
       $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, $url);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
       curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
       $data = curl_exec($ch);
       curl_close($ch);
       dd($data);

        dd($json);
        return view('dashboard.generalinfo.index');
    }
     

  
    public function store(Request $request)
    {
        if($request->hasFile('general_file')){
            foreach ($request->file('general_file') as $name => $value) {
                if($value == null){
                    continue;
                }
                Generalinfo::setValue($name, $value->store('general'));
            }
        }

        foreach ($request->input('general') as $name => $value){
            if($value == null){
                continue;
            }
            Generalinfo::setValue($name, $value);
        }

        session()->flash('success', 'تم تحديث البيانات بنجاح');
        return redirect()->back();
    }
}
