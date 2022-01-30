<?php

namespace App\Imports;

use App\Models\Clinet;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ClientImport implements ToCollection, WithHeadingRow, WithStartRow
{
   
    public function headingRow(): int
    {
        return 3;
    }
    
    /**
     * @return int
     */
    public function startRow(): int
    {
        return 4;
    }
    public function collection(Collection $rows)
    {
    
      
        foreach($rows as $key =>$row){
            dd($row);
            if($row[0]  == null || $row[1] == null ){
                continue;
            }
            // dd($row[7]);
            $client = new Clinet();
            $client->name = $row[0];
            $client->phone = $row[1];
            $client->email =  $row[2];
            $client->birth_date = is_date($row[3]);
            $client->nationality =  $row[4];
            $client->register_time =  $row[5];
            $client->type_of_subscribe = $row[6];
            $client->number_of_operations =  $row[7];
            $client->last_transaction =  $row[8];
            $client->register_date =  $row[9];
            $client->mobile_type =  $row[10];
            $client->expire_date =  $row[11];

            
            $client->save();

        } 
        // return redirect()->back();
        
    }
 


    
}