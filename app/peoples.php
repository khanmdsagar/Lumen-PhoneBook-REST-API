<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class peoples extends Model
{
    public $table = 'peoples'; 
    public $primaryKey = 'id'; 
    public $incrementing = true; 
    public $keyType = 'int'; 
    public $timestamps = false;
}
