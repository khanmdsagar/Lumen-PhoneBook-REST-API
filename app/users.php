<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class USERS extends Model
{
    public $table = 'users'; 
    public $primaryKey = 'id'; 
    public $incrementing = true; 
    public $keyType = 'int'; 
    public $timestamps = false;
}
