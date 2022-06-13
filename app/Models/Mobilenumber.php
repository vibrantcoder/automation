<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
use Route;

class Mobilenumber extends Model
{
    use HasFactory;
    protected $table = 'mobile_number';

    public function getdatatable()
    {
        // $loginUser = Session::all();
        // ccd($loginUser['logindata'][0]['usertype']);
        $requestData = $_REQUEST;
        $columns = array(
            0 => 'mobile_number.id',
            1 => 'countries.shortname',
            2 => 'mobile_number.mobile_number',
            3 => 'mobile_number.operator',
            4 => DB::raw('(CASE WHEN mobile_number.status = "A" THEN "Active" ELSE "Inactive" END)'),
            5 => 'countries.phonecode',
        );
        $query = Mobilenumber ::from('mobile_number')
                        ->join('countries', 'countries.id', '=', 'mobile_number.country_id')
                        ->where('mobile_number.is_deleted','N');


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
                    ->select('mobile_number.id', 'mobile_number.country_id', 'countries.shortname', 'countries.phonecode', 'mobile_number.mobile_number', 'mobile_number.operator', 'mobile_number.status' , DB::raw('(CASE WHEN mobile_number.status = "A" THEN "Active" ELSE "Inactive" END) as statuss '))
                    ->get();

        $data = array();
        $i = 0;

        foreach ($resultArr as $row) {

            $actionhtml  = '';

              $actionhtml =  $actionhtml. '<a href="'.route('edit-device', $row['id']).'" class="btn btn-icon"><i class="fa fa-pencil-square-o text-warning" title="Edit Mobile Number"> </i></a>';


              if($row['status'] == 'A'){
                $status = '<span class="badge badge-md badge-success">'.$row['statuss'].'</span>';

                  $actionhtml =  $actionhtml. '<a href="#" data-toggle="modal" data-target="#deactiveModel" class="btn btn-icon  deactive-mobile-number" data-id="' . $row["id"] . '" title="Inactive Mobile Number" ><i class="fa fa-times text-danger" ></i></a>';

              }else{
                $status = '<span class="badge badge-md badge-danger">'.$row['statuss'].'</span>';

                  $actionhtml =  $actionhtml. '<a href="#" data-toggle="modal" data-target="#activeModel" class="btn btn-icon  active-mobile-number" data-id="' . $row["id"] . '" title="Active Mobile Number" ><i class="fa fa-check text-success" ></i></a>';

              }

             $actionhtml =  $actionhtml. '<a href="#" data-toggle="modal" data-target="#deleteModel" class="btn btn-icon  delete-mobile-number" data-id="' . $row["id"] . '"  title="Delete Mobile Number"><i class="fa fa-trash text-danger" ></i></a>';


            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            // $nestedData[] = $row['id'];
            $nestedData[] = $row['phonecode'].'-'. $row['shortname'];
            $nestedData[] = $row['mobile_number'];
            $nestedData[] = $row['operator'];
            $nestedData[] = $status;
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

    public function add_mobile_number($request){
        $count = Mobilenumber::from('mobile_number')
                ->where('mobile_number.mobile_number', $request->input('mobile_number'))
                ->where('mobile_number.is_deleted', 'N')
                ->count();

            if($count == 0){
                $loginUser = Session::all();
                $objDevice = new Mobilenumber();
                $objDevice->country_id = $request->input('country_code');
                $objDevice->mobile_number = $request->input('mobile_number');
                $objDevice->operator = $request->input('operator');
                $objDevice->status = $request->input('status');
                $objDevice->add_by = $loginUser['logindata'][0]['id'];
                $objDevice->updated_by = $loginUser['logindata'][0]['id'];
                $objDevice->is_deleted = 'N';
                $objDevice->created_at = date('Y-m-d H:i:s');
                $objDevice->updated_at = date('Y-m-d H:i:s');
                if($objDevice->save()){

                    // $destinationPath = public_path('/upload/systemsetting/');
                    $currentRoute = Route::current()->getName();
                    $inputData = $request->input();
                    unset($inputData['_token']);
                    $objAudittrails = new Audittrails();
                    $res = $objAudittrails->add_audit('Insert','admin/'. $currentRoute , json_encode($inputData) ,'Mobile Number' );
                    return 'true';
                }else{
                    return 'false';
                }

        }
        return 'mobile_number_exits';
    }
}
