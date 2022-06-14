<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class Runscript extends Model
{
    use HasFactory;
    protected $table = 'run_script';

    public function save_run_script($divisId, $mobileId, $operatorId){
        $logindetails = Session::all();

        $objRunscript = new Runscript();
        $objRunscript->user_id = $logindetails['logindata'][0]['id'];
        $objRunscript->country_code = $mobileId;
        $objRunscript->divice_id = $divisId;
        $objRunscript->mobile_number = $mobileId;
        $objRunscript->operator = $operatorId;
        $objRunscript->created_at = date('Y-m-d H:i:s');
        $objRunscript->updated_at = date('Y-m-d H:i:s');
        $objRunscript->save();
    }
}
