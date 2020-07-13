<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\users;

class registrationController extends Controller
{
    //registration
    function registration(Request $request){
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $encryptedPassword = Crypt::encrypt($password);

        $getCount = users::where('email', $email)->count();

        if($getCount != 0 ){
            return "User already exists";
        }
        else{
           $result = users::insert([
                'name' => $name,
                'email' => $email,
                'password' => $encryptedPassword,
            ]);

            if($result){
                return "Registration successful";
            }
            else{
                return "Registration failed";
            }
        }
    } 
}
