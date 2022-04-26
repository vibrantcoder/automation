<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Subscriber;
use App\Models\Codenumber;
class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      
        $objCodenumber = new Codenumber();
        $code = $objCodenumber->get_no_by_name('subscriber_no');
           
        $objSubscriber = new Subscriber();
        $objSubscriber->subscriber_no = $code->number;
        $objSubscriber->sr_no = $row[0];
        $objSubscriber->name = $row[1];

        if($row[2] != '' || $row[2] != null){
            $objSubscriber->address_1 = $row[2];    
        }else{
            $objSubscriber->address_1 = $row[2];
        }
        if($row[3] != '' || $row[3] != null){
            $objSubscriber->address_2 = $row[3];    
        }else{
            $objSubscriber->address_2 = $row[3];
        }
        if($row[4] != '' || $row[4] != null){
            $objSubscriber->address_3 = $row[4];    
        }else{
            $objSubscriber->address_3 = $row[4];
        }

        $objSubscriber->area = $row[5];
        $objSubscriber->city = $row[6];
        $objSubscriber->state = $row[7];
        $objSubscriber->pincode = $row[8];
        $objSubscriber->contactno = $row[9];
        if($row[10] != '' || $row[10] != null){
            $objSubscriber->start_date = date("Y-m-d", strtotime($row[10]));
        }else{
            $objSubscriber->start_date = null;
        }
        if($row[11] != '' || $row[11] != null){
            $objSubscriber->end_date = date("Y-m-d", strtotime($row[11]));
        }else{
            $objSubscriber->end_date = null;
        }
        $objSubscriber->landline = $row[12];
        $objSubscriber->email = $row[13];
        $objSubscriber->type = $row[14];
        if($row[15] != '' || $row[15] != null){
            $objSubscriber->price = $row[15];
        }else{
            $objSubscriber->price = '0';
        }
        $objSubscriber->is_deleted = 'N';
        $objSubscriber->created_at = date("Y-m-d H:i:s");
        $objSubscriber->updated_at = date("Y-m-d H:i:s");       
        $objSubscriber->save();
        $objCodenumber = new Codenumber();
        $code = $objCodenumber->auto_increment_no('subscriber_no');
        
    }
}
