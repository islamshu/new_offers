<?php

namespace App\Imports;

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
class CodeImport implements ToCollection, WithValidation ,WithEvents 
{
    use Importable;

    public function collection(Collection $rows)
    {
        // $per->total_codes = 
       
        $code = Session::get('CodePermfomed');
        foreach($rows as $key =>$row){
         
            $codeis = new Performed();
            $codeis->code = $row[0];
            $codeis->peformed_id = $code->id;
            $codeis->save();
        } 
        // return redirect()->back();
        
    }
    public function rules(): array
    {
        return [
            '0' => 'unique:performeds,code',
        ];
    }

    public function registerEvents(): array
    {
        return [
            BeforeImport::class => function (BeforeImport $event) {
                $totalRows = $event->getReader()->getTotalRows();

                if (!empty($totalRows)) {
                    // dd($totalRows['Sheet1']);
                    $per = new CodePermfomed();
                    // dd($totalRows);
                    $per->total_codes = $totalRows['Sheet1'] ;
                    $per-> vendor_id=Session::get('vendor_id');
                    $per->save();
                    Session::put('CodePermfomed', $per);
                }
            }
        ];
    }
    
}