<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
use Route;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BrandExport;

class Brandentry extends Model
{
    use HasFactory;
    protected $table = 'brand_entry';

    public function getdatatable()
    {

        $requestData = $_REQUEST;
        $columns = array(
            0 => 'brand_entry.id',
            1 => 'brand_entry.brand_name',
            2 => 'brand_entry.url',
            3 => 'brand_entry.country_code',
            4 => 'brand_entry.mobile_number',
            5 => DB::raw('(CASE WHEN brand_entry.generate_otp = "Y" THEN "Yes" ELSE "No" END)'),

        );
        $query = Brandentry ::from('brand_entry')
                            ->where('brand_entry.is_deleted','N');


        if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $searchVal = $requestData['search']['value'];
            $query->where(function($query) use ($columns, $searchVal, $requestData) {
                $flag = 0;
                foreach ($columns as $key => $value) {
                    $searchVal = $requestData['search']['value'];
                    if ($requestData['columns'][$key]['searchable'] == 'true') {
                        if ($flag == 0) {
                            $query->where($value, 'like', '%' . $searchVal . '%');
                            $flag = $flag + 1;
                        } else {
                            $query->orWhere($value, 'like', '%' . $searchVal . '%');
                        }
                    }
                }
            });
        }

        $temp = $query->orderBy($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);

        $totalData = count($temp->get());
        $totalFiltered = count($temp->get());

        $resultArr = $query->skip($requestData['start'])
                    ->take($requestData['length'])
                    ->select('brand_entry.id', 'brand_entry.brand_name', 'brand_entry.url', 'brand_entry.country_code', 'brand_entry.mobile_number', 'brand_entry.generate_otp',DB::raw('(CASE WHEN brand_entry.generate_otp = "Y" THEN "Yes" ELSE "No" END) as generate_otps '))
                    ->get();

        $data = array();
        $i = 0;

        foreach ($resultArr as $row) {

            $actionhtml  = '';




              $actionhtml =  $actionhtml. '<a href="'.route('edit-brand-entry', $row['id']).'" class="btn btn-icon"><i class="fa fa-pencil-square-o text-warning" title="Edit Brand Entry"> </i></a>';



            // $actionhtml = '<a href="javscript:;" data-toggle="modal" data-target="#viewAuditTrails" data-id="'.$row['id'].'" class="btn btn-icon viewdata"><i class="fa fa-eye text-info"> </i></a>';
            if($row['generate_otp'] == 'Y'){
                $otp = '<span class="badge badge-md badge-success">'.$row['generate_otps'].'</span>';
            }else{
                $otp = '<span class="badge badge-md badge-danger">'.$row['generate_otps'].'</span>';
            }

            $actionhtml =  $actionhtml. '<a href="#" data-toggle="modal" data-target="#deleteModel" class="btn btn-icon  delete-brand-entry" data-id="' . $row["id"] . '"  title="Delete Brand Entry"><i class="fa fa-trash text-danger" ></i></a>';

            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            // $nestedData[] = $row['id'];
            $nestedData[] = $row['brand_name'];
            $nestedData[] = $row['url'];
            $nestedData[] = $row['country_code'];
            $nestedData[] = $row['mobile_number'];
            $nestedData[] = $otp;
            $nestedData[] = $actionhtml;
            $data[] = $nestedData;
        }
        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );
        return $json_data;
    }

    public function add_brand_entry($request){

        for ($i = 0; $i < count($request->input('brand_name')); $i++) {
            $url = '';
            $country_code = '';

            if($request->input('url')[$i] == '' || $request->input('url')[$i] == null){
                $url = '-';
            }else{
                $url = $request->input('url')[$i];
            }

            if($request->input('country_code')[$i] == '' || $request->input('country_code')[$i] == null){
                $country_code = '-';
            }else{
                $country_code = $request->input('country_code')[$i];
            }

            $brand_entry[] = [
                'brand_name' => $request->input('brand_name')[$i],
                'url' => $url,
                'country_code' => $country_code,
                'mobile_number' => $request->input('mobile_number')[$i],
                'generate_otp' => $request->input('generateotp')[$i],
                'is_deleted' => 'N',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }
        if(Brandentry::insert($brand_entry)){
            $currentRoute = Route::current()->getName();
            $inputData = $request->input();
            unset($inputData['_token']);
            $objAudittrails = new Audittrails();
            $res = $objAudittrails->add_audit('Insert','admin/'. $currentRoute , json_encode($inputData) ,'Brand Entry' );
            Excel::store(new BrandExport, 'BrandDetails.xlsx', 'exceldata');
            return 'true';
        }else{
            return 'false';
        }

            //  }
            //  return 'record_exits';

    }

    public function get_brand_entry_details($editId){
        return Brandentry::from('brand_entry')
                         ->where('brand_entry.id', $editId)
                         ->where('brand_entry.is_deleted', 'N')
                         ->select('brand_entry.id', 'brand_entry.brand_name', 'brand_entry.url', 'brand_entry.country_code', 'brand_entry.mobile_number', 'brand_entry.generate_otp')
                         ->get()
                         ->toArray();
    }

    public function edit_brand_entry($request){
        // $checkRecord = Brandentry::from('brand_entry')
        //     ->where('brand_entry.is_deleted', 'N')
        //     ->where('brand_entry.id','!=', $request->input('editId'))
        //     ->where('brand_entry.brand_name', $request->input('brand_name'))
        //     ->where('brand_entry.url', $request->input('url'))
        //     ->where('brand_entry.country_code', $request->input('country_code'))
        //     ->where('brand_entry.mobile_number', $request->input('mobile_number'))
        //     ->where('brand_entry.generate_otp', $request->input('generate_otp'))
        //     ->count();

        //     if($checkRecord == 0){
            $url ='';
            $country_code ='';
            if($request->input('url') == '' || $request->input('url') == null){
                $url = '-';
            }
            else{
                $url = $request->input('url');
            }
            if($request->input('country_code') == '' || $request->input('country_code') == null){
                $country_code = '-';
            }else{
                $country_code = $request->input('country_code');
            }

                $objBrandentry = Brandentry::find($request->input('editId'));
                $objBrandentry->brand_name = $request->input('brand_name');
                $objBrandentry->url = $url;
                $objBrandentry->country_code = $country_code;
                $objBrandentry->mobile_number = $request->input('mobile_number');
                $objBrandentry->generate_otp = $request->input('generateotp');
                if($objBrandentry->save()){
                    $currentRoute = Route::current()->getName();
                    $inputData = $request->input();
                    unset($inputData['_token']);
                    $objAudittrails = new Audittrails();
                    $res = $objAudittrails->add_audit('Edit','admin/'. $currentRoute , json_encode($inputData) ,'Brand Entry' );
                    Excel::store(new BrandExport, 'BrandDetails.xlsx', 'exceldata');
                    return 'true';
                }else{
                    return 'false';
                }

            // }
            // return 'record_exits';
    }

    public function common_activity_user($data,$type){

        $objBrandentry = Brandentry::find($data['id']);
        if($type == 0){
            $objBrandentry->is_deleted = "Y";
            $event = 'Delete Brand Entry';
        }

        $objBrandentry->updated_at = date("Y-m-d H:i:s");
        if($objBrandentry->save()){
            Excel::store(new BrandExport, 'BrandDetails.xlsx', 'exceldata');
            $currentRoute = Route::current()->getName();
            $objAudittrails = new Audittrails();
            $res = $objAudittrails->add_audit($event, 'admin/'.$currentRoute, json_encode($data), 'Brand Entry');
            return true;
        }else{
            return false ;
        }
    }

    public function get_brand_entry_list(){
        return Brandentry::where('brand_entry.is_deleted','N')
                        ->select('brand_entry.brand_name', 'brand_entry.id')
                        ->get()
                        ->toArray();
    }

}
