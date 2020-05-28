<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\peoples;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{

    function home(){
        return "Lumen Phone Book Api";
    }


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


    function selectData(){
        $selectData = peoples::orderBy('name', 'ASC')->get();
        return $selectData;
    }


    function updateData(Request $request, $id){

        $name   = $request->input('name');
        $phone   = $request->input('phone');
        $email  = $request->input('email');
 
        //DB::table('students')
        $result = peoples::where('id', $id) -> update(['name'=> $name, 'phone'=> $phone, 'email'=> $email]);
 
       
        if($result == true){
            return 'Updated Successfully';
        }
        else{
            return 'Update Failed';
        }

    }


    function deleteData($id){

        $result = peoples::where('id', $id)->delete();
 
        if($result == true){
            return 'Deleted Successfully';
        }
        else{
            return 'Delete Failed';
        }
    }


    function searchData($name){
    
      $result = peoples::orderBy('name', 'ASC')
        ->where('name', 'LIKE', "%{$name}%")
        ->get();
      return $result;

    }


}
