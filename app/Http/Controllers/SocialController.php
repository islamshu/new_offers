<?php

namespace App\Http\Controllers;

use App\Models\Social;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    
    public function index()
    {
        return view('dashboard.social.index');
    }
    public function store(Request $request)
    {
        // if($request->hasFile('general_file')){
        //     foreach ($request->file('general_file') as $name => $value) {
        //         if($value == null){
        //             continue;
        //         }
        //         Social::setValue($name, $value->store('general'));
        //     }
        // }

        // foreach ($request->input('general') as $name => $value){
        //     if($value == null){
        //         continue;
        //     }
        //     Social::setValue($name, $value);
        // }

        // session()->flash('success', 'تم تحديث البيانات بنجاح');
        // return redirect()->back();
    }
}
