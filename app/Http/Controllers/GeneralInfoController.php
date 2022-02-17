<?php

namespace App\Http\Controllers;

use App\Generalinfo;
use Illuminate\Http\Request;

class GeneralInfoController extends Controller
{
    public function index()
    {
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
