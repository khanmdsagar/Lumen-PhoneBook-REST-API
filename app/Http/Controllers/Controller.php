<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\peoples;
use \Firebase\JWT\JWT;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    function home(){
        return "Opps!";
    }

    //inserting data
    function insertData(Request $request){
        $token           =  $request->input('access_token');
        $key             =  env('TOKEN_KEY');
        $decode          =  JWT::decode($token, $key, array('HS256'));
        $decodeed_array  =  (array) $decode;

        $user_email      =  $decodeed_array['user_email'];
        $name            =  $request->input('name');
        $phone           =  $request->input('phone');
        $email           =  $request->input('email');
 
        //DB::table('students')
        $result = peoples::insert(['name'=> $name, 'phone'=> $phone, 'email'=> $email, 'user_email'=> $user_email]);
 
        if($result == true){
            return "Inserted Successfully";
        }
        else{
            return "Insert Failed";
        }
    }


    //getting all data
    function selectData(Request $request){
        $token           =  $request->input('access_token');
        $key             =  env('TOKEN_KEY');
        $decode          =  JWT::decode($token, $key, array('HS256'));
        $decodeed_array  =  (array) $decode;

        $user_email      =  $decodeed_array['user_email'];

        $selectData = peoples::where('user_email', $user_email)->orderBy('name', 'ASC')->get();
        if($selectData == true){
            return $selectData;
        }
        else{
            return 'Failed to retrive';
        }
       
    }


    //updating data
    function updateData(Request $request){
        $token           =  $request->input('access_token');
        $id           =  $request->input('id');

        $key             =  env('TOKEN_KEY');
        $decode          =  JWT::decode($token, $key, array('HS256'));
        $decodeed_array  =  (array) $decode;

        $user_email      =  $decodeed_array['user_email'];

        $name   = $request->input('name');
        $phone  = $request->input('phone');
        $email  = $request->input('email');
 
        //DB::table('students')
        $result = peoples::where('user_email', $user_email)->where('id', $id)-> update(['name'=> $name, 'phone'=> $phone, 'email'=> $email]);
 
       
        if($result == true){
            return 'Updated Successfully';
        }
        else{
            return 'Update Failed';
        }

    }


    //deleting data
    function deleteData(Request $request){
        $token           =  $request->input('access_token');
        $id              =  $request->input('id');

        $key             =  env('TOKEN_KEY');
        $decode          =  JWT::decode($token, $key, array('HS256'));
        $decodeed_array  =  (array) $decode;

        $user_email      =  $decodeed_array['user_email'];

        $result = peoples::where('user_email', $user_email)->where('id', $id)->delete();
 
        if($result == true){
            return 'Deleted Successfully';
        }
        else{
            return 'Delete Failed';
        }
    }


    //searching data
    function searchData(Request $request){
      $name            =  $request->input('name');
      $token           =  $request->input('access_token');
      $email           =  $request->input('email');
      
      $key             =  env('TOKEN_KEY');
      $decode          =  JWT::decode($token, $key, array('HS256'));
      $decodeed_array  =  (array) $decode;

      $user_email      =  $decodeed_array['user_email'];

      $result = peoples::where('user_email', $user_email)->orderBy('name', 'ASC')
        ->where('name', 'LIKE', "{$name}%")
        ->get();

      return $result;
    }


}
