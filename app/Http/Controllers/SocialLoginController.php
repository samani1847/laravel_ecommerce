<?php

namespace OneStop\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use Auth;
use OneStop\User;

class SocialLoginController extends Controller
{
    /*
    * Redirect the user to the GitHub authentication page.
    *
    * @return Response
    */
   public function redirectToProvider($provider)
   {
        return Socialite::driver($provider)->redirect();
   }

   /**
    * Obtain the user information from GitHub.
    *
    * @return Response
    */
   public function handleProviderCallback($provider)
   {
        $user = Socialite::driver($provider)->user();

        $authUser = $this->findOrCreateUser($user);
        Auth::login($authUser, true);
        return redirect('/');
    
   }

   private function findOrCreateUser($user)
   {    
        $authUser = User::where('email', $user->email)->first();
        if($authUser){
            return $authUser;
        } 
        
       return User::create([
            'name' => $user->name,
            'email' => $user->email,
            'password' =>str_random(8)]);
   }
}
