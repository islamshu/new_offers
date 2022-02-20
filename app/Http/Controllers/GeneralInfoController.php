<?php

namespace App\Http\Controllers;

use App\Models\GeneralInfo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class GeneralInfoController extends Controller
{
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
        // $token = get_general('sms_token');
        // $response = Http::withoutVerifying()->get('https://api.oursms.com/api-a/billing/credits?token=whyfA4pML1nN4w3Yj7_WpKDo29NIOWav-0EqK38KRcohttp://jsonplaceholder.typicode.com/todos/2');

        //     dd($response);
        // return redirect()->route('get_cridit');
        return view('dashboard.generalinfo.index');

    }
    public function test()
    {
        $response = Http::withoutVerifying()->get('https://api.oursms.com/api-a/billing/credits?token=whyfA4pML1nN4w3Yj7_WpKDo29NIOWav-0EqK38KRcohttp://jsonplaceholder.typicode.com/todos/2');

            dd($response);
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
