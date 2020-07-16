<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\peoples;
use \Firebase\JWT\JWT;
use Image;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    function home(){
        return "Welcome to myPhoneBook api";
    }

     //photo upload 
     function onFileUpload(Request $request){
        
        $imageFile = $request->file('photo');
        $imageFileExtension = $imageFile->getClientOriginalExtension();
        $imageFileName = date('Ymdhis.') . $imageFileExtension;

        Image::make($imageFile)
                ->resize(100, 100)
                ->save('photos/'. $imageFileName);

    return  $imageFileName;
    }


    //inserting data
    function insertData(Request $request){
        $token           =  $request->input('access_token');
        $key             =  env('TOKEN_KEY');
        $decode          =  JWT::decode($token, $key, array('HS256'));
        $decodeed_array  =  (array) $decode;

        $name            =  $request->input('name');
        $phone           =  $request->input('phone');
        $email           =  $request->input('email');
        $user_email      =  $decodeed_array['user_email'];
        $photo           =  $request->input('photo');

        //DB::table('students')
        $result = peoples::insert(['name'=> $name, 'phone'=> $phone, 'email'=> $email, 'user_email'=> $user_email, 'photo'=> $photo]);
 
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
        $photo  = $request->input('photo');

        if($photo == null){
            $result = peoples::where('user_email', $user_email)->where('id', $id)-> update(['name'=> $name, 'phone'=> $phone, 'email'=> $email]);
            
            if($result == true){
                return 'Updated Successfully';
            }
            else{
                return 'Update Failed';
            }
        }
        else{
            
            $getPhotoName = peoples::find($id);
            unlink('photos/'. $getPhotoName->photo);

            $result = peoples::where('user_email', $user_email)->where('id', $id)-> update(['name'=> $name, 'phone'=> $phone, 'email'=> $email, 'photo'=> $photo]);
            
            if($result == true){
                return 'Updated Successfully';
            }
            else{
                return 'Update Failed';
            }
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

        $getPhotoName = peoples::find($id);
        unlink('photos/'. $getPhotoName->photo);

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
