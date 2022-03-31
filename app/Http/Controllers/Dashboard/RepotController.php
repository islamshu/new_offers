<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Clinet;
use App\Models\Offer;
use App\Models\Subscriptions_User;
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
                return $q->whereBetween('created_at', [Carbon::now(), $request->to]);
            } elseif ($request->to == $request->from) {
                return $q->whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59']);
            } else {
                return $q->whereBetween('created_at', [$request->from, $request->to]);
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
                return $q->whereBetween('register_date', [Carbon::now(), $request->register_to]);
            } elseif ($request->register_to == $request->register_form) {
                return $q->whereBetween('register_date', [$request->register_form, $request->register_to]);
            } else {
                return $q->whereBetween('register_date', [$request->register_form, $request->register_to]);
            }
        });
        $query->when($request->sub_form, function ($q) use ($request) {
            if ($request->sub_to == null && $request->sub_form != null) {
                return $q->whereBetween('start_date', [$request->sub_form, Carbon::now()]);
            } elseif ($request->sub_to != null && $request->sub_form == null) {
                return $q->whereBetween('start_date', [Carbon::now(), $request->sub_to]);
            } elseif ($request->sub_to == $request->sub_form) {
                return $q->whereBetween('start_date', [$request->sub_form, $request->sub_to]);
            } else {
                return $q->whereBetween('start_date', [$request->sub_form, $request->sub_to]);
            }
        });


        $clients = $query->get();
        if (
            $request->sub_form == null && $request->sub_to == null && $request->register_form == null &&
            $request->register_to == null && $request->sub_type == null && $request->emaill == null && $request->phone == null
        ) {
            $clients = Clinet::whereDate('created_at', Carbon::today())->get();

            return view('dashboard.repots.clients', compact('clients', 'request'));
        } else {
            return view('dashboard.repots.clients', compact('clients', 'request'));
        }
    }
    public function clients_admin(Request $request)
    {

        $query = Clinet::query();

        $query->when($request->register_form, function ($q) use ($request) {
            if ($request->register_to == null && $request->register_form != null) {
                return $q->whereBetween('register_date', [$request->register_form, Carbon::now()]);
            } elseif ($request->register_to != null && $request->register_form == null) {
                return $q->whereBetween('register_date', [Carbon::now(), $request->register_to]);
            } elseif ($request->register_to == $request->register_form) {
                return $q->whereBetween('register_date', [$request->register_form, $request->register_to]);
            } else {
                return $q->whereBetween('register_date', [$request->register_form, $request->register_to]);
            }
        });
        $query->when($request->last_from, function ($q) use ($request) {
            if ($request->last_to == null && $request->last_from != null) {
                $q->whereHas('subs_last', function ($qq) use ($request) {
                    return $qq->whereBetween('created_at', [$request->last_from, Carbon::now()]);
                });
            } elseif ($request->last_to != null && $request->last_from == null) {
                $q->whereHas('subs_last', function ($qq) use ($request) {
                    return $qq->whereBetween('created_at', [Carbon::now(), $request->last_to]);
                });
            } elseif ($request->last_to == $request->last_from) {
                $q->whereHas('subs_last', function ($qq) use ($request) {
                    return $qq->whereBetween('created_at', [$request->last_from, $request->last_to]);
                });
            } else {
                $q->whereHas('subs_last', function ($qq) use ($request) {
                    return $qq->whereBetween('created_at', [$request->last_from, $request->last_to]);
                });
            }
        });


        $query->when($request->transaction_from, function ($q) use ($request) {
            if ($request->transaction_to == null && $request->transaction_from != null) {
                $q->whereHas('trans', function ($qq) use ($request) {
                    return $qq->whereBetween('created_at', [$request->transaction_from, Carbon::now()]);
                });
            } elseif ($request->transaction_to != null && $request->transaction_from == null) {
                $q->whereHas('trans', function ($qq) use ($request) {
                    return $qq->whereBetween('created_at', [Carbon::now(), $request->transaction_to]);
                });
            } elseif ($request->transaction_to == $request->transaction_from) {
                $q->whereHas('trans', function ($qq) use ($request) {
                    return $qq->whereBetween('created_at', [$request->transaction_from, $request->transaction_to]);
                });
            } else {
                $q->whereHas('trans', function ($qq) use ($request) {
                    return $qq->whereBetween('created_at', [$request->transaction_from, $request->transaction_to]);
                });
            }
        });


        $clients = $query->get();
        return view('dashboard.repots.clients_admin', compact('clients', 'request'));
    }
    public function get_branch_ajax(Request $request, $locale)
    {

        $offers = Branch::where('vendor_id', $request->venodr_id)->get();
        return response()->json($offers);
    }
    public function offers_reports(Request $request)
    {

        $query = Offer::query();
        $query->when($request->created_form, function ($q) use ($request) {
            if ($request->created_to == null && $request->created_form != null) {
                return $q->whereBetween('created_at', [$request->created_form, Carbon::now()]);
            } elseif ($request->created_to != null && $request->created_form == null) {
                return $q->whereBetween('created_at', [Carbon::now(), $request->created_form]);
            } elseif ($request->created_to == $request->created_form) {
                return $q->whereBetween('created_at', [$request->created_form, $request->created_to]);
            } else {
                return $q->whereBetween('created_at', [$request->created_form, $request->created_to]);
            }
        });
        $query->when($request->offer_status, function ($q) use ($request) {
            if ($request->offer_status == 'active') {
                return $q->where('status', 1);
            } elseif ($request->offer_status == 'deactive') {
                return $q->where('status', 0);
            }
        });

        $query->when($request->vendor_status, function ($q) use ($request) {
            $q->whereHas('vendor', function ($qq) use ($request) {
                return $qq->where('status', $request->vendor_status);
            });
        });
        $query->when($request->number_date, function ($q) use ($request) {
            return $q->whereDate('end_time', [Carbon::now()->addDays($request->number_date)->format('Y-m-d') . ' 00:00:00', Carbon::now()->addDays($request->number_date)->format('Y-m-d') . ' 23:59:59']);
        });
        $query->when($request->city_id, function ($q) use ($request) {
            $q->whereHas('vendor', function ($qq) use ($request) {
                $qq->whereHas('cities', function ($qqq) use ($request) {
                    return    $qqq->where('city_id', $request->city_id);
                });
            });
        });
        $query->when($request->category_id, function ($q) use ($request) {
            $q->whereHas('vendor', function ($qq) use ($request) {
                $qq->whereHas('categorys', function ($qqq) use ($request) {
                    return    $qqq->where('category_id', $request->category_id);
                });
            });
        });

        $offers = $query->paginate(10);
        return view('dashboard.repots.offers', compact('offers', 'request'));
    }
    function fetch_data(Request $request)
    {
        if ($request->ajax()) {

            $test_q = str_replace(" ", "%", $request->get('query'));

            $query = Offer::query()->orwhere('name_en', 'like', '%' . $test_q . '%');


            $query->when($request->created_form, function ($q) use ($request) {
                if ($request->created_to == null && $request->created_form != null) {
                    return $q->whereBetween('created_at', [$request->created_form, Carbon::now()]);
                } elseif ($request->created_to != null && $request->created_form == null) {
                    return $q->whereBetween('created_at', [Carbon::now(), $request->created_form]);
                } elseif ($request->created_to == $request->created_form) {
                    return $q->whereBetween('created_at', [$request->created_form, $request->created_to]);
                } else {
                    return $q->whereBetween('created_at', [$request->created_form, $request->created_to]);
                }
            });
            $query->when($request->offer_status, function ($q) use ($request) {
                if ($request->offer_status == 'active') {
                    return $q->where('status', 1);
                } elseif ($request->offer_status == 'deactive') {
                    return $q->where('status', 0);
                }
            });

            $query->when($request->vendor_status, function ($q) use ($request) {
                $q->whereHas('vendor', function ($qq) use ($request) {
                    return $qq->where('status', $request->vendor_status);
                });
            });

            $query->when($request->number_date, function ($q) use ($request) {
                return $q->whereDate('end_time', [Carbon::now()->addDays($request->number_date)->format('Y-m-d') . ' 00:00:00', Carbon::now()->addDays($request->number_date)->format('Y-m-d') . ' 23:59:59']);
            });
            $query->when($request->city_id, function ($q) use ($request) {
                $q->whereHas('vendor', function ($qq) use ($request) {
                    $qq->whereHas('cities', function ($qqq) use ($request) {
                        return    $qqq->where('city_id', $request->city_id);
                    });
                });
            });
            $query->when($request->category_id, function ($q) use ($request) {
                $q->whereHas('vendor', function ($qq) use ($request) {
                    $qq->whereHas('categorys', function ($qqq) use ($request) {
                        return    $qqq->where('category_id', $request->category_id);
                    });
                });
            });


            $offers = $query->paginate(10);


            return view('dashboard.repots._offers', compact('offers', 'request'));
        }
    }
    function subscriprion_reports(Request $request)
    {
        if ($request->date_from != null && $request->date_to != null) {
            $trial = Subscriptions_User::where('payment_type', 'trial')->whereBetween('created_at', [$request->date_from, $request->date_to])->count();
            $activation = Subscriptions_User::where('payment_type', 'activition_code')->whereBetween('created_at', [$request->date_from, $request->date_to])->count();
            $sumactivation = Subscriptions_User::where('payment_type', 'activition_code')->whereBetween('created_at', [$request->date_from, $request->date_to])->sum('paid');
            $visa = Subscriptions_User::where('payment_type', 'VISA/MASTER')->whereBetween('created_at', [$request->date_from, $request->date_to])->count();
            $sumvisa = Subscriptions_User::where('payment_type', 'VISA/MASTER')->whereBetween('created_at', [$request->date_from, $request->date_to])->sum('paid');
            $mada = Subscriptions_User::where('payment_type', 'MADA')->whereBetween('created_at', [$request->date_from, $request->date_to])->count();
            $summada = Subscriptions_User::where('payment_type', 'MADA')->whereBetween('created_at', [$request->date_from, $request->date_to])->sum('paid');
            $applepay = Subscriptions_User::where('payment_type', 'Apple Pay')->whereBetween('created_at', [$request->date_from, $request->date_to])->count();
            $sumapplepay = Subscriptions_User::where('payment_type', 'Apple Pay')->whereBetween('created_at', [$request->date_from, $request->date_to])->sum('paid');
            $applepaymada = Subscriptions_User::where('payment_type', 'Apple Pay (Mada)')->whereBetween('created_at', [$request->date_from, $request->date_to])->count();
            $sumapplepaymada = Subscriptions_User::where('payment_type', 'Apple Pay (Mada)')->whereBetween('created_at', [$request->date_from, $request->date_to])->sum('paid');
            $stc = Subscriptions_User::where('payment_type', 'STC Pay')->whereBetween('created_at', [$request->date_from, $request->date_to])->count();
            $sumstc = Subscriptions_User::where('payment_type', 'STC Pay')->whereBetween('created_at', [$request->date_from, $request->date_to])->sum('paid');
            $admin = Subscriptions_User::where('payment_type', 'admin')->whereBetween('created_at', [$request->date_from, $request->date_to])->count();
            $excel = Subscriptions_User::where('payment_type', 'excel_import')->whereBetween('created_at', [$request->date_from, $request->date_to])->count();
            return view('dashboard.repots.subscriprion_reports', compact('trial', 'activation', 'sumactivation', 'visa', 'mada', 'applepay', 'applepaymada', 'stc', 'sumvisa', 'summada', 'sumapplepay', 'sumapplepaymada', 'sumstc', 'admin', 'excel', 'request'));
        }

        if ($request->date_from != null && $request->date_to == null) {
            $trial = Subscriptions_User::where('payment_type', 'trial')->whereBetween('created_at', [$request->date_from, Carbon::now()])->count();
            $activation = Subscriptions_User::where('payment_type', 'activition_code')->whereBetween('created_at', [$request->date_from, Carbon::now()])->count();
            $sumactivation = Subscriptions_User::where('payment_type', 'activition_code')->whereBetween('created_at', [$request->date_from, Carbon::now()])->sum('paid');
            $visa = Subscriptions_User::where('payment_type', 'VISA/MASTER')->whereBetween('created_at', [$request->date_from, Carbon::now()])->count();
            $sumvisa = Subscriptions_User::where('payment_type', 'VISA/MASTER')->whereBetween('created_at', [$request->date_from, Carbon::now()])->sum('paid');
            $mada = Subscriptions_User::where('payment_type', 'MADA')->whereBetween('created_at', [$request->date_from, Carbon::now()])->count();
            $summada = Subscriptions_User::where('payment_type', 'MADA')->whereBetween('created_at', [$request->date_from, Carbon::now()])->sum('paid');
            $applepay = Subscriptions_User::where('payment_type', 'Apple Pay')->whereBetween('created_at', [$request->date_from, Carbon::now()])->count();
            $sumapplepay = Subscriptions_User::where('payment_type', 'Apple Pay')->whereBetween('created_at', [$request->date_from, Carbon::now()])->sum('paid');
            $applepaymada = Subscriptions_User::where('payment_type', 'Apple Pay (Mada)')->whereBetween('created_at', [$request->date_from, Carbon::now()])->count();
            $sumapplepaymada = Subscriptions_User::where('payment_type', 'Apple Pay (Mada)')->whereBetween('created_at', [$request->date_from, Carbon::now()])->sum('paid');
            $stc = Subscriptions_User::where('payment_type', 'STC Pay')->whereBetween('created_at', [$request->date_from, Carbon::now()])->count();
            $sumstc = Subscriptions_User::where('payment_type', 'STC Pay')->whereBetween('created_at', [$request->date_from, Carbon::now()])->sum('paid');
            $admin = Subscriptions_User::where('payment_type', 'admin')->whereBetween('created_at', [$request->date_from, Carbon::now()])->count();
            $excel = Subscriptions_User::where('payment_type', 'excel_import')->whereBetween('created_at', [$request->date_from, Carbon::now()])->count();
            return view('dashboard.repots.subscriprion_reports', compact('trial', 'activation', 'sumactivation', 'visa', 'mada', 'applepay', 'applepaymada', 'stc', 'sumvisa', 'summada', 'sumapplepay', 'sumapplepaymada', 'sumstc', 'admin', 'excel', 'request'));
        }
        $trial = Subscriptions_User::where('payment_type', 'trial')->count();
        $activation = Subscriptions_User::where('payment_type', 'activition_code')->count();
        $sumactivation = Subscriptions_User::where('payment_type', 'activition_code')->sum('paid');
        $visa = Subscriptions_User::where('payment_type', 'VISA/MASTER')->count();
        $sumvisa = Subscriptions_User::where('payment_type', 'VISA/MASTER')->sum('paid');
        $mada = Subscriptions_User::where('payment_type', 'MADA')->count();
        $summada = Subscriptions_User::where('payment_type', 'MADA')->sum('paid');
        $applepay = Subscriptions_User::where('payment_type', 'Apple Pay')->count();
        $sumapplepay = Subscriptions_User::where('payment_type', 'Apple Pay')->sum('paid');
        $applepaymada = Subscriptions_User::where('payment_type', 'Apple Pay (Mada)')->count();
        $sumapplepaymada = Subscriptions_User::where('payment_type', 'Apple Pay (Mada)')->sum('paid');
        $stc = Subscriptions_User::where('payment_type', 'STC Pay')->count();
        $sumstc = Subscriptions_User::where('payment_type', 'STC Pay')->sum('paid');
        $admin = Subscriptions_User::where('payment_type', 'admin')->count();
        $excel = Subscriptions_User::where('payment_type', 'excel_import')->count();
        return view('dashboard.repots.subscriprion_reports', compact('trial', 'activation', 'sumactivation', 'visa', 'mada', 'applepay', 'applepaymada', 'stc', 'sumvisa', 'summada', 'sumapplepay', 'sumapplepaymada', 'sumstc', 'admin', 'excel', 'request'));
    }
    public function get_detelis($lang,$request, $type)
    {
        dd($request);
    }
}
