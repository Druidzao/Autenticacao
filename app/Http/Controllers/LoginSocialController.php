<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class LoginSocialController extends Controller
{
    public function redirectToGithub(){
        return Socialite::driver('github')->redirect();
    }

    public function handleGithubCallback(){
        $user = Socialite::driver('github')->stateless()->user();
        //\dd($user);
        if ($this->loginOrRegister($user)){
            return redirect()->route('dashboard');
        }
    }

    private function loginOrRegister($data){
        $user = User::where('email', '=', $data->email)->first();

        if(!$user){
            $user = User::create([
                'name' => $data->nickname,
                'avatar' => $data->avatar,
                'email' => $data->email,
                'password' => ''
            ]);
        }

        Auth::login($user, true);

        return true;
    }
}