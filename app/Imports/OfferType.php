<?php

namespace App\Imports;

use App\Models\Branch;
use App\Models\City;
use App\Models\CodePermfomed;
use App\Models\Performed;
use App\User;
use Session;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeImport;

class OfferType implements ToCollection     
{
    
   

    public function collection(Collection $rows)
    {
        // dd($rows);
        // dd( $this->id);
        // $per->total_codes = 
       
      
        foreach($rows as $key =>$row){
          
            if($key == 0 || $key == 1  ){
                continue;
            }
          
            $offertype = new Offertype();
            $offertype->offer_id = $row[7];
            $offertype->offer_type = $row[1];

            $offertype->price = $row[2];
            // $offertype->price = $row[15];
            $offertype->price_after_discount= $row[3];
            $offertype->price_befor_discount = $row[4];
            $offertype->discount_value = $row[5];
            $offertype->discount_type = $row[6];
            if( $row[8] == null){
                $offertype->save();
            }
            
             
            

        } 
        // return redirect()->back();
        
    }
 


    
}