<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Auth;

class LoginSocialController extends Controller
{

    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(){
        $user = Socialite::driver('google')->stateless()->user();
        //\dd($user);
        if ($this->loginOrRegister($user)){
            return redirect()->route('dashboard');
        }
    }

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
            if ($data->nickname != null){
                $user = User::create([
                    'name' => $data->nickname,
                    'avatar' => $data->avatar,
                    'email' => $data->email,
                    'password' => ''
                ]);
            }else{
                $user = User::create([
                    'name' => $data->name,
                    'avatar' => $data->avatar,
                    'email' => $data->email,
                    'password' => ''
                ]);
            }
        }

        Auth::login($user, true);

        return true;
    }
}