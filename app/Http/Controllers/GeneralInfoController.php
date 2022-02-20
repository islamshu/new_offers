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
        $token = get_general('sms_token');

        return redirect()->route('get_cridit');
    }
    public function test()
    {
        // dd('x');
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://reqres.in',
        ]);

        $response = $client->request('GET', '/api/users', [
            'query' => [
                'page' => '2',
            ]
        ]);

        $body = $response->getBody();
        $arr_body = json_decode($body);
        dd($arr_body);
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
