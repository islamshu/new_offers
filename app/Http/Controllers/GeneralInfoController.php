<?php

namespace App\Http\Controllers;

use App\Models\GeneralInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GeneralInfoController extends Controller
{
    public function firebase()
    {
        return view('dashboard.generalinfo.firebase');
    }
    public function index()
    {
        $token = get_general('sms_token');
      $url = 'https://api.oursms.com/api-a/billing/credits?token='.$token;
   
    $response = Http::get($url);
    dd($response);
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
