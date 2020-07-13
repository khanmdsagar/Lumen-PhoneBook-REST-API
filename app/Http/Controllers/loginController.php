<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\users;
use Illuminate\Support\Facades\Crypt;
use \Firebase\JWT\JWT;

class loginController extends Controller
{
    //login
    function login(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');

        $isUser = users::where('email', $email)->count();

        if($isUser){
            $getUser = users::where('email', $email)->get();
            $userPassword =  $getUser[0]->password;
            $decryptedPassword = Crypt::decrypt($userPassword);
    
           if($password == $decryptedPassword){
               $key = env('TOKEN_KEY');
               $payload = array(
                   "site" => "phonebook.kmsplanet.com",
                   "user_email" => $email,
                   "iat" => time(),
                   "exp" => time() + 604800
               );
               $jwt = JWT::encode($payload, $key);
    
               return response()->json(['TOKEN' => $jwt, 'STATUS' => 'success']);
           }
           else{
               return "Password didn't match";
           }
    
        }
        else{
            return "User doesn't exist";
        }
       
    }//end
}
