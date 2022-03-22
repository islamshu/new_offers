<?php

namespace App\Imports;

use App\Models\Branch;
use App\Models\Offertype as ModelsOffertype;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;


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
          
            $offertype = new ModelsOffertype();
            $offertype->offer_id = $row[7];
            $offertype->offer_type = $row[1];

            $offertype->price = $row[2];
            // $offertype->price = $row[15];
            $offertype->price_after_discount= $row[3];
            $offertype->price_befor_discount = $row[4];
            $offertype->discount_value = $row[5];
            $offertype->discount_type = $row[6];
            if( $row[11] == null){
                $offertype->save();
            }
            
             
            

        } 
        // return redirect()->back();
        
    }
 


    
}