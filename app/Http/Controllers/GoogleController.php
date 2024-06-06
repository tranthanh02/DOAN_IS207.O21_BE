<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class GoogleController extends Controller
{
    //
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);
                $token = $finduser->createToken('token-name')->plainTextToken;
                return redirect()->to(env('CLIENT_URL') . '?token=' . $token);
            } else {
                $newUser = User::updateOrCreate(['userEmail' => $user->email], [
                    'userName' => $user->name,
                    'google_id' => $user->id,
                    'userPassword' =>  Hash::make('123456dummy')
                ]);

                Auth::login($newUser);
                $token = $newUser->createToken('token-name')->plainTextToken;
                return redirect()->to(env('CLIENT_URL') . '?token=' . $token);
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
