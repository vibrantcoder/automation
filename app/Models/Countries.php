<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\Constraint\Count;

class Countries extends Model
{
    use HasFactory;
    protected $table = 'countries';

    public function get_countries_details(){
        return Countries::from('countries')
                      ->select('countries.id', 'countries.shortname', 'countries.name', 'countries.phonecode')
                      ->get()
                      ->toArray();
    }
}
