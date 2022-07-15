<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Importdata;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportBrands implements ToModel
{
    /**
    * @param Collection $collection
    */

    public function model(array $row)
    {
        $exits_array = [];

        $count  = Importdata::from('brand_entry')
                            ->where('brand_entry.brand_name', $row[0])
                            ->where('brand_entry.is_deleted', 'N')
                            ->count();
        if($count != 0){
            array_push($exits_array, $row[0]);
        }else{
            $objImportdata = new Importdata();
            $objImportdata->brand_name = $row[0];
            if($row[1] == '' || $row[1] == null){
                $row[1] = '-';
            }

            $objImportdata->url = $row[1];

            if($row[2] == '' || $row[2] == null){
                $row[2] = '-';
            }
            
            $objImportdata->country_code = $row[2];
            $objImportdata->mobile_number = $row[3];
            $objImportdata->generate_otp = $row[4];
            $objImportdata->is_deleted = 'N';
            $objImportdata->created_at = date('Y-m-d H:i:s');
            $objImportdata->updated_at = date('Y-m-d H:i:s');
            $objImportdata->save();
        }
    }
}
