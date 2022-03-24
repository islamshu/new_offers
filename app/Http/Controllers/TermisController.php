<?php

namespace App\Http\Controllers;

use App\Models\Termis;
use Illuminate\Http\Request;

class TermisController extends Controller
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
    public function index()
    {

        return view('dashboard.pages.term')->with('term',Termis::orderBy('sort','asc')->get());
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
        $page = new Termis();
        $page->title_ar = $request->title_ar;
        $page->title_en = $request->title_en;
        $page->content_ar = $request->content_ar;
        $page->content_en = $request->content_en;
        $page->sort = Termis::count() +1;
        
        $page->save();
        return redirect()->back()->with(['succss'=>trans('add succeefully')]);
    }
    public function update_sort(Request $request)
    {
        if($request->has('ids')){
            $arr = explode(',',$request->input('ids'));
            foreach($arr as $sortOrder => $id){
                $menu = Termis::find($id); 
                $menu->sort = $sortOrder;
                $menu->update(['sort'=>$sortOrder]);
            }
            return ['success'=>true,'message'=>'Updated'];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Termis  $term
     * @return \Illuminate\Http\Response
     */
    public function show(Termis $term)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Termis  $term
     * @return \Illuminate\Http\Response
     */
    public function edit(Termis $term)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Termis  $term
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Termis $term)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Termis  $term
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale,$id)
    {
       $about= Termis::find($id);
       $about->delete();
       return response()->json(['icon' => 'success', 'title' => 'termis deleted successfully'], 200);

    }
}
