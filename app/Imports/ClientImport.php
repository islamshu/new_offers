<?php

namespace App\Imports;

use App\Models\Clinet;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ClientImport implements ToCollection
   {
    
    public function collection(Collection $rows)
    {
    
      
        foreach($rows as $key =>$row){
          
            if($row[0]  == null || $row[1] == null || $key == 0 || $key == 1 ){
                continue;
            }
            $bod_date = trim(str_replace('\n', '', (str_replace('\r', '', $row[3]))));

            if($bod_date != null){
                $bod_date  = $bod_date.' 00:00:00'; 
            }else{
                $bod_date= null; 
            }

            $client = new Clinet();
            $client->name = $row[0];
            $client->phone = $row[1];
            $client->email =  str_replace(' ','',$row[2]);
            $client->birth_date = $bod_date;
            $client->nationality =  $bod_date;
            $client->register_time =  $row[5];
            $client->type_of_subscribe = $row[6];
            $client->number_of_operations =  $row[7];
            $client->last_transaction =   $row[8];
            $client->is_unlimited =   1;
            $client->gender =   1;
            $client->city_id =   15;
            $client->register_date =   Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[9]));
            $client->mobile_type =  $row[10];
            $client->expire_date =   Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[11]));
            $client->start_date = Carbon::now();
            $client->save();

        } 
        // return redirect()->back();
        
    }
 


    
}