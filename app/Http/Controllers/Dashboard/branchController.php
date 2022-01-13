<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\City;
use App\Models\Neighborhood;
use App\Models\Role;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Vendor_cities;
use App\Models\Vendor_neighborhood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class branchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_branches($locale ,$id){

        $branches = Branch::where('vendor_id', $id)->get();
        $vendor  = Vendor::find($id); 
    
         return view('dashboard.branch.get_branches', compact('branches','vendor'));

    }
    public function index()
    {
        if (Auth::user()->hasRole('Admin')) {
            // if (Auth::user()->isAbleTo('read-branch')) {
                $vendors = Vendor::get();
                // $branches = Branch::paginate(20);
            // }
        } elseif (Auth::user()->hasRole('Vendors')) {
            // if (Auth::user()->isAbleTo('read-branch')) {
                $vendor  = Vendor::find($id); 
                $city = Vendor_cities::where('vendor_id',$id)->get();


                $branches = Branch::where('vendor_id', Auth::user()->vendor_id)->get();
                return view('dashboard.branch.get_branches', compact('branches','vendor','city'));

            // }
        } elseif (Auth::user()->hasRole('Enterprises')) {
            // if (Auth::user()->isAbleTo('read-branch')) {
                $vendors = Vendor::where('enterprise_id', Auth::user()->ent_id)->get();
                // $branches = array();
                // foreach ($vendors as $one_vendor) {
                //     // dd($one_vendor->branches);
                //     if ($one_vendor->branches->count() > 0) {
                //         foreach ($one_vendor->branches as $one_branch) {
                //             array_push($branches, $one_branch);
                //         }
                //     }
                // }
            // }
        }
        return view('dashboard.branch.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (Auth::user()->hasRole('Enterprises')) {
            $vendor = Vendor::where('enterprise_id',Auth::user()->ent_id)->get();
        }elseif(Auth::user()->hasRole('Admin')){
            $vendor = Vendor::all();
        }
        return response()->view('dashboard.branch.create', compact('vendor'));


    }
    public  function create_branch($locale,$id)
    {
       
        $vendor =Vendor::find($id);
        
        $city = Vendor_cities::where('vendor_id',$id)->where('status','active')->get();
        dd($city);
       
        return response()->view('dashboard.branch.create', compact('vendor','city'));
    }
    public function vendorCitiesAjax(Request $request){
        
          
        $city = Vendor_cities::where('vendor_id',$request->id)->with('city')->get();
        
        return response()->json($city);
    }

    public function vendorNeighborhoodAjax(Request $request)
    {
       
    //    $v= Vendor_neighborhood::where('vendor_id', $request->vendor_id)->get();
    
        $neighborhood = Vendor_neighborhood::where('vendor_id', $request->vendor_id)->with('neighborhood')
        ->whereHas('neighborhood', function ($q) use ($request) {
            $q->where('city_id', $request->city_id);
          })->get();
    
        // dd($neighborhood);

        return response()->json($neighborhood);
    }    
    public function cityBranch($locale,$id){
       $branch = Branch::find($id)->city_id;
       $cities  = City::where('id',$branch)->get();
    //    dd($cities);
       return response()->view('dashboard.city.index', compact('cities'));
    }
    public function neighborhoods_branch($locale,$id){
        $branch = Branch::find($id)->neighborhood_id;
        $Neighborhoods  = Neighborhood::where('id',$branch)->get();
     //    dd($cities);
        return response()->view('dashboard.neighborhood.index', compact('Neighborhoods'));
     }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator($request->all(), [
            'name_ar' => 'required|string|min:3',
            'name_en' => 'required|string|min:3',
            // 'email' => 'required|email|unique:users',
            'phone' => 'required|unique:branches',
            // 'street' => 'required',
            // 'password' => 'required|min:6',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if (!$validator->fails()) {
            try {
                DB::beginTransaction();
            $new_branch = new Branch();
            if (Auth::user()->hasRole('Vendors')) {
                
                $new_branch->vendor_id = Auth::user()->vendor_id;
            } else {
                $new_branch->vendor_id = $request->kt_select2_1;
            }
            $new_branch->name_ar = $request->name_ar;
            $new_branch->name_en = $request->name_en;
            $new_branch->city_id = $request->city_id;
            $new_branch->neighborhood_id = $request->neighborhood_id;
            $new_branch->latitude = $request->latitude;
            $new_branch->longitude = $request->longitude;
            $new_branch->phone = $request->phone;
            $new_branch->street = $request->street;
            $new_branch->status = 'active';
            $new_branch->save();

            DB::commit();
            return response()->json(['icon' => 'success', 'title' => 'Vendor created successfully']);
           
        } catch (\Exception $e) {
            DB::rollback();


            return response()->json(['icon' => 'error', 'title' => 'error when insert data'], 400);
        }

        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($lang, $id)
    {
        $branch = Branch::find($id);
         
        return response()->view('dashboard.branch.show', compact('branch'));
    }
    public function country_branch($locale,$id){
        
    }
    public function city_branch($locale,$id){
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function edit($locale,$id)
    {
        
        $branch = Branch::find($id);
        return response()->view('dashboard.branch.edit',compact('branch'));
// // /       $user= User::with('branch')->where('branch_id',$id)->first();
//         if (Auth::user()->hasRole('Enterprises')) {
//             $vendor = Vendor::where('enterprise_id',Auth::user()->ent_id)->get();
//             return response()->view('dashboard.branch.edit', compact('branch'));

//         }elseif(Auth::user()->hasRole('Admin')){
//             $vendor = Vendor::all();
//             return response()->view('dashboard.branch.edit',compact('branch'));

//         }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    public function updateBranch(Request $request,$locale,$id){
        // $user= User::with('branch')->where('branch_id',$id)->first();
        $branch = Branch::find($id);
        // dd($branch);

        $validator = Validator($request->all(), [
            'name_ar' => 'required|string|min:3',
            'name_en' => 'required|string|min:3',
            // 'email'=>'required|email|unique:users,email,'.$user->id,
            'phone' => 'required|unique:branches,phone,'.$branch->id,
            // 'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if (!$validator->fails()) {
            try {
                DB::beginTransaction();
            $branch->name_ar = $request->name_ar;
            $branch->name_en = $request->name_en;
            $branch->city_id = $request->city_id;
             $branch->neighborhood_id = $request->neighborhood_id;
             $branch->latitude = $request->latitude;
             $branch->longitude = $request->longitude;
             $branch->phone = $request->phone;
             $branch->street = $request->street;
             $branch->status = 'active';
             $branch->save();
            //Create New User
        
            //Assign Vendor Role To New User
            DB::commit();
            return response()->json(['icon' => 'success', 'title' => 'Branch updated successfully']);
            

        } catch (\Exception $e) {
            DB::rollback();
            // dd($e);

            return response()->json(['icon' => 'error', 'title' =>'error when insert data'], 400);

        }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request){
        $user = Branch::findOrFail($request->user_id);
        
        $user->status = $request->status;
        $user->save();
    
        return response()->json(['message' => 'User status updated successfully.']);
    }
    public function destroy($locale,$id)
    {
        $vendor =Branch::find($id);
        $vendor->delete();
        return response()->json(['icon' => 'success', 'title' => 'branch deleted successfully'], 200);

    }
}
