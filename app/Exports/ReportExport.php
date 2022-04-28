<?php

namespace App\Exports;

use App\Models\Brandentry;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use App\Models\Resultreport;

class ReportExport implements FromArray, WithHeadings, ShouldAutoSize, WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */

    function __construct($data)
    {
        $this->from = $data['from'];
        $this->to = $data['to'];
        $this->result_value = $data['result_value'];
        $this->sender_from = $data['sender_from'];
    }

    public function array(): array
    {
        
        $objResultreport = new Resultreport();
        $res = $objResultreport->download_excel_download($this->from, $this->to, $this->result_value, $this->sender_from);
       
        $data = [];
        $i = 1;
        foreach($res as $key => $value){
            $data[$key]['srno'] = $i;
            $data[$key]['event_time'] = $value['event_time'];
            $data[$key]['result_value'] = $value['result_value'];
            $data[$key]['sender_from'] =$value['sender_from'];
            $data[$key]['sender_address'] = $value['sender_address'];
            $data[$key]['recipient_code'] = $value['recipient_code'];
            $data[$key]['text_body'] = $value['text_body'];
            $i++;
        }
        
        return $data;
    }

    public function headings(): array
    {
        return [
            'Sr. No',
            'Event Time Stamp',
            'Result Value',
            'Sender From',
            'Sender SCCPAddress',
            'Recipient Code',
            'TextBody',
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
            'F' => NumberFormat::FORMAT_NUMBER,
            'G' => NumberFormat::FORMAT_TEXT,
        ];
    }
}
