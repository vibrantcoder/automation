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
    protected $brand_list = [];
    protected $device = '';
    protected $mobile_number= '';
    protected $opertoer = '';    
    function __construct($requestData)
    {
        $this->brand_list = $requestData['brnad_name'];
        $this->device = $requestData['device'];
        $this->mobile_number = $requestData['mobile_number'];
        $this->opertoer = $requestData['operator'];
    }

    public function array(): array
    {
        if (!empty(Auth()->guard('admin')->user())) {
            $logindata = Auth()->guard('admin')->user();
        }        

        $device_name = get_device_name($this->device);
        $operator = get_operator_name($this->opertoer);
        $coutry_code = get_operator_name($this->mobile_number);        

        $res=  Brandentry::where('brand_entry.is_deleted', 'N')
                ->whereIn('brand_entry.id', $this->brand_list)
                ->select( 'brand_entry.brand_name', 'brand_entry.url', 'brand_entry.country_code', 'brand_entry.mobile_number', 'brand_entry.generate_otp')
                ->get();
        
        $data = [];
        $i = 1;
        foreach($res as $key => $value){
            $data[$key]['srno'] = $i;
            $data[$key]['brand_name'] = $value['brand_name'];

            if($value['url'] == null ||  $value['url'] == ''){
                $data[$key]['url'] = '-';
            }else{
                $data[$key]['url'] = $value['url'];
            }

            $data[$key]['country_code'] = $coutry_code[0]['phonecode'];
            $data[$key]['mobile_number'] = $coutry_code[0]['mobile_number'];
            $data[$key]['generate_otp'] = $value['generate_otp'];
            $data[$key]['device_name'] = $device_name[0]['device_name'];
            $data[$key]['device_id'] = $device_name[0]['id'];
            $data[$key]['operator'] = $operator;
            $data[$key]['run_by'] = $logindata['id'];
            $data[$key]['username'] = $logindata['first_name'] .' '.$logindata['last_name'];
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
