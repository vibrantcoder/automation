<?php

namespace App\Exports;

use App\Models\Brandentry;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;


class BrandExport implements FromArray, WithHeadings, ShouldAutoSize, WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */



    public function array(): array
    {
        $res=  Brandentry::where('brand_entry.is_deleted', 'N')
                        ->select( 'brand_entry.brand_name', 'brand_entry.url', 'brand_entry.country_code', 'brand_entry.mobile_number', 'brand_entry.generate_otp')
                        ->get();
        $data = [];
        $i = 1;
        foreach($res as $key => $value){
            $data[$key]['srno'] = $i;
            $data[$key]['brand_name'] = $value['brand_name'];
            $data[$key]['url'] = $value['url'];
            $data[$key]['country_code'] =$value['country_code'];
            $data[$key]['mobile_number'] = $value['mobile_number'];
            $data[$key]['generate_otp'] = $value['generate_otp'];
            $i++;
        }

        return $data;
    }

    public function headings(): array
    {
        return [
            'Sr. No',
            'Brand Name',
            'Brand URL',
            'Country Code',
            'Mobile Number',
            'Generate OTP',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_TEXT,
            'C' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_TEXT,
            'E' => NumberFormat::FORMAT_NUMBER,
            'F' => NumberFormat::FORMAT_TEXT,
        ];
    }
}
