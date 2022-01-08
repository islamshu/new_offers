<?php

namespace App\Imports;

use App\Models\Enterprise;
use App\Models\Role;
use App\Models\User;
use App\Models\Vendor;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Auth;
use File;
use Maatwebsite\Excel\Concerns\WithStartRow;

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

        $vendor = new Vendor();
        $vendor->name_ar = $row['name_ar'];
        $vendor->name_en = $row['name_en'];
        $vendor->desc_en = $row['desc_en'];
        $vendor->desc_ar = $row['desc_ar'];
        $vendor->owner_name = $row['owner_name'];
        $vendor->commercial_registration_number = $row['commercial_registration_number'];
        $vendor->telephoone = $row['telephoone'];
        $vendor->mobile = $row['mobile'];
        // $vendor->address = $row['address'];
        $vendor->status = $row['status'];
        $vendor->vat_type = $row['vat_type'];
        $vendor->vat = $row['vat'];
        $vendor->vat_no= $row['vat_no'];

        $vendor->image =$image;
        $vendor->cover_image = $image;
        $vendor->vat =Auth::user()->ent_id;
        $vendor->save();
        $vendor->categorys()->sync(json_decode($row['category_id'],false));
    
       
    }
}
}
