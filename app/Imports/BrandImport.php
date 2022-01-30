<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\City;
use App\Models\Enterprise;
use App\Models\Neighborhood;
use App\Models\Role;
use App\Models\SoialVendor;
use App\Models\User;
use App\Models\Vendor;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class BrandImport implements ToCollection, WithHeadingRow, WithStartRow 
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function startRow(): int
    {
        return 2;
    }
 
    public function collection(Collection $rows)    {
        {

        $image = Enterprise::find(auth()->user()->ent_id)->image;
        // dd($image);
        File::copy(public_path('images/enterprise/'.$image), public_path('images/brand/'.$image));
        File::copy(public_path('images/enterprise/'.$image), public_path('images/vendor_cover/'.$image));
         
        foreach($rows as $key=>$row){
            // dd($row);
        if($row['name_ar'] == null){
            continue;
        }
        

        
        // dd(json_decode($row['category_id']));
        $vendor = new Vendor();
        $vendor->name_ar = $row['name_ar'];
        $vendor->name_en = $row['name_en'];
        $vendor->desc_en = $row['desc_en'];
        $vendor->desc_ar = $row['desc_ar'];
        $vendor->owner_name = $row['owner_name'];
        $vendor->commercial_registration_number = $row['commercial_registration_number'];
        $vendor->telephoone = $row['telephoone'];
        $vendor->mobile = $row['mobile'];
        $vendor->status = $row['status'];
        $vendor->vat_type = $row['vat_type'];
        $vendor->vat = $row['vat'];
        $vendor->vat_no= $row['vat_no'];
        $vendor->menu_link= $row['menu_link'];
        $vendor->is_pincode= (string)$row['is_pincode'];
        $vendor->qr_code= $row['qr_code'];
        $vendor->image =$image;
        $vendor->cover_image = $image;
        $vendor->enterprise_id=Auth::user()->ent_id;
        $vendor->type_refound = 'auto';
        if($vendor->qr_code != null){
        $Qrimage = QrCode::format('svg')
            ->size(200)->errorCorrection('H')
            ->generate((string)$vendor->qr_code);
        $output_file =  time() . '.svg';
        $file =  Storage::disk('local')->put($output_file, $Qrimage);
        $vendor->qr_image = $output_file;
        }
        $vendor->save();
        // $vendor->categorys()->sync(json_decode($row['category_id'],false));
        DB::table('categories_vendors')->insert(
            ['category_id' => 1, 'vendor_id' => $vendor->id]
        );
        foreach(json_decode($row['category']) as $cat){
            $cate =Category::where('name_ar','like','%'.$cat.'%')->first()->id;
            DB::table('categories_vendors')->insert(
                ['category_id' => $cate, 'vendor_id' => $vendor->id]
            );
        }

        
        $so = new SoialVendor();
        $so->facebook = $row['facebook'];
        $so->twitter = $row['twitter'];
        $so->instagram = $row['instagram'];
        $so->snapchat = $row['snapchat'];
        $so->vendor_id = $vendor->id;
        $so->save();

        
        // dd($so);
        
        DB::table('image_vendors')->insert(
            ['image' => $image, 'vendor_id' => $vendor->id]
        );
        DB::table('currencies_vendors')->insert(
            ['currency_id' => 2, 'vendor_id' => $vendor->id]
        );

        DB::table('vendor_countries')->insert(
            ['country_id' => 1, 'vendor_id' => $vendor->id]
        );
        DB::table('soial_vendors')->insert(
            [ 'vendor_id' => $vendor->id,'facebook' => $row['facebook'],'twitter'=> $row['twitter'],'snapchat' => $row['snapchat'],'instagram'=> $row['instagram']]
        );
        $cities = City::where('country_id',1)->get();
        foreach($cities as $city){
            DB::table('vendor_cities')->insert(
                ['city_id' => $city->id, 'vendor_id' => $vendor->id,'status'=>'active']
            );
            $neighborhoods = Neighborhood::where('city_id',$city->id)->get();
            foreach($neighborhoods as $na){
                DB::table('vendor_neighberhood')->insert(
                    ['neighborhood_id' => $na->id, 'vendor_id' => $vendor->id]
                );
            }
            
        }

    
        

       
    }
       
    }
}
}
