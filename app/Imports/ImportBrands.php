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
        // $count
        $objImportdata = new Importdata();
        $objImportdata->brand_name = $row[0];
        $objImportdata->url = $row[1];
        $objImportdata->country_code = $row[2];
        $objImportdata->mobile_number = $row[3];
        $objImportdata->generate_otp = $row[4];
        $objImportdata->is_deleted = 'N';
        $objImportdata->created_at = date('Y-m-d H:i:s');
        $objImportdata->updated_at = date('Y-m-d H:i:s');
        $objImportdata->save();
    }

    // public function collection(Collection $collection)
    // {
    //     //
    // }
}
