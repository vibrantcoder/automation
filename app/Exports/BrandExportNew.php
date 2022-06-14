<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use App\Models\Brandentry;
use Session;

class BrandExportNew implements  FromArray, WithHeadings, ShouldAutoSize, WithColumnFormatting
{
    function __construct($device, $mobile_number, $opertoer)
    {
        $this->device = $device;
        $this->mobile_number = $mobile_number;
        $this->opertoer = $opertoer;
    }

    public function array(): array
    {
        $logindata = Session::all();

        $device_name = get_device_name($this->device);
        $operator = get_operator_name($this->opertoer);
        $coutry_code = get_operator_name($this->mobile_number);
        // ccd($coutry_code);

        $res=  Brandentry::where('brand_entry.is_deleted', 'N')
                ->select( 'brand_entry.brand_name', 'brand_entry.url', 'brand_entry.country_code', 'brand_entry.mobile_number', 'brand_entry.generate_otp')
                ->get();
        $data = [];
        $i = 1;
        foreach($res as $key => $value){
        $data[$key]['srno'] = $i;
        $data[$key]['brand_name'] = $value['brand_name'];
        $data[$key]['url'] = $value['url'];
        $data[$key]['country_code'] =$coutry_code[0]['phonecode'];
        $data[$key]['mobile_number'] = $coutry_code[0]['mobile_number'];
        $data[$key]['generate_otp'] = $value['generate_otp'];
        $data[$key]['device_name'] = $device_name[0]['device_name'];
        $data[$key]['device_id'] = $device_name[0]['id'];
        $data[$key]['operator'] = $coutry_code[0]['operator'];
        $data[$key]['run_by'] = $logindata['logindata'][0]['id'];
        $data[$key]['username'] = $logindata['logindata'][0]['first_name'] .' '.$logindata['logindata'][0]['first_name'];



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
            'Device Name',
            'Device id',
            'Opertor',
            'Run by',
            'Username',
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
