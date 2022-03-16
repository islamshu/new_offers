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
        $query = Transaction::query()->where('vendor_id',auth()->user()->vendor_id);
        $query->when($request->referance, function ($q) use ($request) {  
            return $q->where('refreance_number', $request->referance);
        });
        $query->when($request->branch_id, function ($q) use ($request) {
            return $q->where('branch_id', $request->branch_id);
        });
        $query->when($request->from, function ($q) use ($request) {
            if($request->to == null && $request->from != null){
                return $q->whereBetween('created_at', [$request->from,Carbon::now()->format('Y-m-d')]);
            }elseif($request->to != null && $request->from == null){
                return $q->whereBetween('created_at', [Carbon::now()->format('Y-m-d'),$request->to,]);
            }else{
                return $q->whereBetween('created_at', [$request->from,$request->to,]);
            }
        });
        $trans = $query->get();
        $vendors = Vendor::where('enterprise_id',auth()->user()->ent_id)->get();
        $branches = Branch::where('vendor_id',auth()->user()->vendor_id)->get();
        return view('dashboard.repots.transaction',compact('request','trans','branches','vendors'));
    }
}
