<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Transaction;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RepotController extends Controller
{
    public function transaction(Request $request){
        $query = Transaction::query()->where('enterprise_id',auth()->user()->ent_id);
        $query->when($request->from, function ($q) use ($request) {
            if($request->to == null && $request->from != null){
                return $q->whereBetween('created_at', [$request->from,Carbon::now()]);
            }elseif($request->to != null && $request->from == null){
                return $q->whereBetween('created_at', [Carbon::now(),$request->to,]);
            }else{
                return $q->whereBetween('created_at', [$request->from,$request->to,]);
            }
        });
        dd($query->get());
        $query->when($request->vendor_id, function ($q) use ($request) {
            return $q->where('vendor_id', $request->vendor_id);
        });
        $query->when($request->branch_id, function ($q) use ($request) {
            return $q->where('branch_id', $request->branch_id);
        });
       
        $trans = $query->get();
        $vendors = Vendor::where('enterprise_id',auth()->user()->ent_id)->get();
        $branches = Branch::where('vendor_id',auth()->user()->vendor_id)->get();
        return view('dashboard.repots.transaction',compact('request','trans','branches','vendors'));
    }
    public function get_branch_ajax(Request $request,$locale )
    {

       $offers = Branch::where('vendor_id',$request->venodr_id)->get();
       return response()->json($offers);

    }
}
