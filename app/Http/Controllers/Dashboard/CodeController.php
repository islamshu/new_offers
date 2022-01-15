<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;


use App\Models\Code;
use App\Models\CodeSubscription;
use App\Models\Subscription;
use Illuminate\Http\Request;

class CodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $codes = Code::get();
        return response()->view('dashboard.code.index',compact('codes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subs = Subscription::where('type_paid','paid')->get();
        return response()->view('dashboard.code.create',compact('subs'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'name_ar'=>'required',
            'name_en'=>'required',
            'type'=>'required',
            'type_code'=>'required',
            'type_of_limit'=>'required',
            'price'=>'required'
        ]);
        if (!$validator->fails()) {
        $code = new Code();
        $code->name_ar = $request->name_ar;
        $code->name_en = $request->name_en;
        $code->type = $request->type;
        $code->sub_id = $request->sub_id;
        $code->price = $request->price;
        if($code->type == 'single'){
            $code->number_of_code = 1;
            $code->total_remain = 1;
        }else{
            $code->number_of_code = $request->number_of_code;
            $code->total_remain = $request->number_of_code;

        }
        $code->type_of_limit = $request->type_of_limit;
        if($request->type_of_limit == 'unlimit'){
            $code->start_at = $request->start_at;
            $code->end_at = $request->end_at;
        }
        
        $code->sub_id = $request->sub_id;
        $code->save();
        if($request->type_code == 'manual'){
            $codesub = new CodeSubscription();
            $codesub->code = $request->code;
            $codesub->sub_id = $request->sub_id;
            $codesub->save();

        }else{
            $code_num = $request->number_of_code;
            for($i= 0;$i < $code_num  ;$i++  ){
                $codesub = new CodeSubscription();
                $codesub->code = mt_rand(100000000,999999999);
                $codesub->sub_id = $request->sub_id;
                $codesub->save();
            }
        }
        return response()->json(['icon' => 'success', 'title' => 'code created successfully'], $code ? 200 : 400);
    } else {
        return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
    }


    }

    public function update_code(Request $request,$locale,$id)
    {
        $code = Code::find($id);
        $validator = Validator($request->all(), [
            'name_ar'=>'required',
            'name_en'=>'required',
            'type'=>'required',
            'type_code'=>'required',
            'type_of_limit'=>'required',
        ]);
        if (!$validator->fails()) {
        
        $code->name_ar = $request->name_ar;
        $code->name_en = $request->name_en;
        $code->type = $request->type;
        $code->sub_id = $request->sub_id;
        if($code->type == 'single'){
            $code->number_of_code = 1;
            $code->total_remain = 1;
        }else{
            $code->number_of_code = $request->number_of_code;

        }
        $code->type_of_limit = $request->type_of_limit;
        if($request->type_of_limit == 'unlimit'){
            $code->start_at = $request->start_at;
            $code->end_at = $request->end_at;
        }
        
        $code->sub_id = $request->sub_id;
        $code->save();
        if($request->type_code == 'manual'){
            $codesub = new CodeSubscription();
            $codesub->code = $request->code;
            $codesub->sub_id = $request->sub_id;
            $codesub->save();

        }else{
            $code_num = $request->number_of_code;
            for($i= 0;$i < $code_num  ;$i++  ){
                $codesub = new CodeSubscription();
                $codesub->code = mt_rand(100000000,999999999);
                $codesub->sub_id = $request->sub_id;
                $codesub->save();
            }
        }
        return response()->json(['icon' => 'success', 'title' => 'code created successfully'], $code ? 200 : 400);
    } else {
        return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
    }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function show(Code $code)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function edit($locale,$id)
    {
        $subs = Subscription::where('type_paid','paid')->get();
        $code = Code::find($id);
        return response()->view('dashboard.code.edit',compact('subs','code'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Code $code)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale,$id)
    {
        $offers = Code::where('id', $id)->first();
        $offers->delete();
        return response()->json(['icon' => 'success', 'title' => 'code deleted successfully'], 200);

    }
}
