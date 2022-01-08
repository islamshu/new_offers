<?php

namespace App\Imports;

use App\Models\Enterprise;
use App\Models\Role;
use App\Models\User;
use App\Models\Vendor;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Auth;
use File;
use Maatwebsite\Excel\Concerns\WithStartRow;

class BrandImport implements ToModel, WithHeadingRow, WithStartRow
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
    public function model(array $row)
    {
        
          
           
       
        $image = Enterprise::find(auth()->user()->ent_id)->image;
        // dd($image);
        File::copy(public_path('images/enterprise/'.$image), public_path('images/brand/'.$image));
       
        return new Vendor([
           'name_ar' => $row['name_ar'],
           'name_en' => $row['name_en'],
           'desc_en' => $row['desc_en'],
           'desc_ar' => $row['desc_ar'],
           'owner_name' => $row['owner_name'],
           'commercial_registration_number' => $row['commercial_registration_number'],
           'telephoone' => $row['telephoone'],
           'mobile' => $row['mobile'],
            //address => $row['address'],
           'status' => $row['status'],
           'vat_type' => $row['vat_type'],
           'vat' => $row['vat'],
           'vat_no' => $row['vat_no'],
           'image' =>$image,
           'cover_image' => $image,
           'enterprise_id' =>Auth::user()->ent_id,
         ]);
        
    //    categorys()->sync(json_decode($row['category_id'],false));

    

        //Assign Vendor Role To New User
        // $role = Role::where('name', 'Vendors')->first();
        // $user->attachRole($role);
        // foreach ($role->permissions as $one_permission) {
        //     $user->attachPermission($one_permission);
        // }
       
    }
}
