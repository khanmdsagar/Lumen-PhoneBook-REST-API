<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use \Firebase\JWT\JWT;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
  
        $this->app['auth']->viaRequest('api', function ($request) {
        
            $token = $request->input('access_token');
            $key = env('TOKEN_KEY');

            try{
                $decode = JWT::decode($token, $key, array('HS256'));
                return new User();
            }
            catch(\Exception $e){
                return null;
            }
            
        });
    }
}
