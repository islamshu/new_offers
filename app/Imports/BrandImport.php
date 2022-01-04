<?php

namespace App\Imports;

use App\Models\Role;
use App\Models\User;
use App\Models\Vendor;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Auth;

class BrandImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $vendor = new Vendor();
        $vendor->name_ar = $row['name_ar'];
        $vendor->name_en = $row['name_en'];
        $vendor->desc_en = $row['desc_en'];
        $vendor->desc_ar = $row['desc_ar'];
        $vendor->owner_name = $row['owner_name'];
        $vendor->commercial_registration_number = $row['commercial_registration_number'];
        $vendor->telephoone = $row['telephoone'];
        $vendor->mobile = $row['mobile'];
        $vendor->address = $row['address'];
        $vendor->status = $row['status'];
        $vendor->vat_type = $row['vat_type'];
        $vendor->vat = $row['vat'];

        $vendor->image = $row['image'];
        $vendor->cover_image = $row['cover_image'];
        $vendor->vat =Auth::user()->ent_id;
        $vendor->save();
        $vendor->categorys()->sync(json_decode($row['cateogry_id'],false));

        $user = new User();
        $user->username =$vendor->name_en;
        $user->password =  bcrypt($row['password']);
        $user->email = $row['email'];
        $user->last_ip = '';
        $user->last_login = now();
        $user->name = $vendor->name_en;
        $user->vendor_id =$vendor->id;
        $user->ent_id =Auth::user()->ent_id;
        $user->save();
        

        //Assign Vendor Role To New User
        $role = Role::where('name', 'Vendors')->first();
        $user->attachRole($role);
        foreach ($role->permissions as $one_permission) {
            $user->attachPermission($one_permission);
        }
       
    }
}
