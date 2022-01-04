<?php


namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Models\Clinet;
use App\Models\Country;
use Illuminate\Http\Request;

class ClinetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.clinets.index')->with('clinets',Clinet::get());
    }


    public function create()
    {
        $countries = Country::get(); 
        return view('dashboard.clinets.create',compact('countries'));
    }


    public function store(Request $request)
    {
        //
    }


    public function show($locale,$id)
    {
      $member =   Clinet::find($id);
      return view('dashboard.clinets.show')->with('member',$member);
    }


    public function edit(Clinet $clinet)
    {
        //
    }

    public function update(Request $request, Clinet $clinet)
    {
        //
    }

  
    public function destroy(Clinet $clinet)
    {
        //
    }
}
