<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions =Transaction::orderBy('desc','id')->get(); 
        return view('dashboard.transaction.index')->with('transactions',$transactions);
    }
}
