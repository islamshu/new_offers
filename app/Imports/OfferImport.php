<?php

namespace App\Imports;

use App\Models\Branch;
use App\Models\CodePermfomed;
use App\Models\Offer;
use App\Models\Offerimage;
use App\Models\Offertype;
use App\Models\Performed;
use App\Models\Vendor;
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
use File;

class OfferImport implements ToCollection     
{
    private $id;
    public function __construct( $id) 
    {
        $this->id = $id;
    }
    
   

    public function collection(Collection $rows)
    {
        // dd($rows);
        // dd( $this->id);
        // $per->total_codes = 
       
        $image = Vendor::find($this->id)->image;
        // dd($image);
        File::copy(public_path('images/brand/'.$image), public_path('images/primary_offer/'.$image));
        foreach($rows as $key =>$row){
 
            if($key == 0 ){
                continue;
            }
            // dd($row[7]);
            $offer = new Offer();
            $offer->vendor_id = (int)$this->id;
            $offer->name_ar = $row[0];
            $offer->name_en = $row[1];
            $offer->desc_ar =  $row[2];
            $offer->desc_en = $row[3];
            $offer->terms_ar =  $row[4];
            $offer->terms_en =  $row[5];
            $offer->member_type = $row[6];
            $offer->usege_member =  $row[7];
            $offer->usage_member_number =  $row[8];
            $offer->usege_system =  $row[9];
            $offer->usage_number_system =  $row[10];
            $offer->price =  $row[11];
            $offer->start_time =  $row[12];
            $offer->end_time =  $row[13];
            $offer->datetime_use = 'deactive';
            $offer->systemCoupon_use= 'deactive';
            $offer->exchange_cash = 'deactive';
            $offer->payment_type = $row[14];
            $offer->save();
            $offertype = new Offertype();
            $offertype->offer_id = $offer->id;
            $offertype->offer_type = $row[15];
            $offertype->save();
            $offerimage = new Offerimage();
            $offerimage->offer_id =  $offer->id;
            $offerimage->primary_image = $image;
            $array = [];
            array_push($array,$image);
            $offerimage->image =json_decode($image);
            $offerimage->save();

          

        } 
        // return redirect()->back();
        
    }
 


    
}