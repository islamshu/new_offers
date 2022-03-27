<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Clinet;
use App\Models\Transaction;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RepotController extends Controller
{
    public function transaction(Request $request)
    {
        $query = Transaction::query()->where('enterprise_id', auth()->user()->ent_id);
        $query->when($request->from, function ($q) use ($request) {
            if ($request->to == null && $request->from != null) {
                return $q->whereBetween('created_at', [$request->from, Carbon::now()]);
            } elseif ($request->to != null && $request->from == null) {
                return $q->whereBetween('created_at', [Carbon::now(), $request->to,]);
            } elseif ($request->to == $request->from) {
                return $q->whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59']);
            } else {
                return $q->whereBetween('created_at', [$request->from, $request->to,]);
            }
        });

        $query->when($request->vendor_id, function ($q) use ($request) {
            return $q->where('vendor_id', $request->vendor_id);
        });

        $query->when($request->branch_id, function ($q) use ($request) {
            return $q->where('branch_id', $request->branch_id);
        });
        // dd($query->get());

        $trans = $query->get();
        $vendors = Vendor::where('enterprise_id', auth()->user()->ent_id)->get();
        $branches = Branch::where('vendor_id', auth()->user()->vendor_id)->get();
        if ($request->from == null && $request->to == null && $request->vendor_id == null && $request->branch_id == null) {
            $trans = Transaction::query()->where('enterprise_id', auth()->user()->ent_id)->whereDate('created_at', Carbon::today())->get();

            return view('dashboard.repots.transaction', compact('request', 'trans', 'branches', 'vendors'));
        } else {
            return view('dashboard.repots.transaction', compact('request', 'trans', 'branches', 'vendors'));
        }
    }
    public function clients(Request $request)
    {

        $query = Clinet::query();

        $query->when($request->email, function ($q) use ($request) {
            return $q->where('email', 'like', '%' . $request->email . '%');
        });
        $query->when($request->phone, function ($q) use ($request) {
            return $q->where('phone', $request->phone);
        });
        $query->when($request->sub_type, function ($q) use ($request) {
            return $q->where('type_of_subscribe', 'like', '%' . $request->sub_type . '%');
        });
        $query->when($request->register_form, function ($q) use ($request) {
            if ($request->register_to == null && $request->register_form != null) {
                return $q->whereBetween('register_date', [$request->register_form, Carbon::now()]);
            } elseif ($request->register_to != null && $request->register_form == null) {
                return $q->whereBetween('register_date', [Carbon::now(), $request->register_to,]);
            } elseif ($request->register_to == $request->register_form) {
                return $q->whereBetween('register_date', [$request->register_form, $request->register_to]);
            } else {
                return $q->whereBetween('register_date', [$request->register_form, $request->register_to,]);
            }
        });
        $query->when($request->sub_form, function ($q) use ($request) {
            if ($request->sub_to == null && $request->sub_form != null) {
                return $q->whereBetween('start_date', [$request->sub_form, Carbon::now()]);
            } elseif ($request->sub_to != null && $request->sub_form == null) {
                return $q->whereBetween('start_date', [Carbon::now(), $request->sub_to,]);
            } elseif ($request->sub_to == $request->sub_form) {
                return $q->whereBetween('start_date', [$request->sub_form, $request->sub_to]);
            } else {
                return $q->whereBetween('start_date', [$request->sub_form, $request->sub_to,]);
            }
        });


        $clients = $query->get();
        if (
            $request->sub_form == null && $request->sub_to == null && $request->register_form == null &&
            $request->register_to == null && $request->sub_type == null && $request->emaill == null && $request->phone == null
        ) {
            dd('k');
            $clients = Clinet::whereDate('created_at', Carbon::today())->get();

            return view('dashboard.repots.clients', compact('clients', 'request'));
        } else {
            dd('uu');
            return view('dashboard.repots.clients', compact('clients', 'request'));
        }
    }
    public function get_branch_ajax(Request $request, $locale)
    {

        $offers = Branch::where('vendor_id', $request->venodr_id)->get();
        return response()->json($offers);
    }
}
