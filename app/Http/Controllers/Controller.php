<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\peoples;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    function insertData(Request $request){
        $name    =  $request->input('name');
        $phone   =  $request->input('phone');
        $email   =  $request->input('email');
 
        //DB::table('students')
        $result = peoples::insert(['name'=>$name, 'phone'=> $phone, 'email'=>$email]);
 
        if($result == true){
            return "Inserted Successfully";
        }
        else{
            return "Insert Failed";
        }
    }
}
