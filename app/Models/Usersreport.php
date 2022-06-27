<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usersreport extends Model
{
    use HasFactory;
    protected $table = 'users_report';

    public function add_user_report($userId, $response, $systemno){
        $objUsersreport = new Usersreport();
        $objUsersreport->user_id = $userId;
        $objUsersreport->response = $response;
        $objUsersreport->system_no = $systemno;
        $objUsersreport->created_at = date('Y-m-d H:i:s');
        $objUsersreport->updated_at = date('Y-m-d H:i:s');
        return $objUsersreport->save();
    }
}
