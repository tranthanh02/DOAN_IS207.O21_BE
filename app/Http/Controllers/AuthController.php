<?php

namespace App\Http\Controllers;

use App\Models\User;
use Google_Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        try {
            $request->validate([
                'userName' => 'required|string',
                'userAddress' => 'required|string',
                'userPhoneNumber' => 'required|string',
                'userEmail' => 'required|email|unique:users,userEmail',
                'userPassword' => 'required|string',
            ]);

            $user = User::create([
                'userName' => $request->userName,
                'userEmail' => $request->userEmail,
                'userAddress' => $request->userAddress,
                'userPhoneNumber' => $request->userPhoneNumber,
                'userPassword' => Hash::make($request->userPassword),

            ]);

            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'user' => $user->userId,
                'token' => $token,
            ], 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'userEmail' => 'required|email',
            'userPassword' => 'required|string',
        ]);

        $user = User::where('userEmail', $credentials['userEmail'])->first();

        if ($user && Hash::check($credentials['userPassword'], $user->userPassword)) {
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                'user' => $user->userId,
                'token' => $token,
            ], 200);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    public function getUserInfo()
    {
        try {

            $user = Auth::user();

            if ($user) {
                return response()->json(['user' => $user], 200);
            } else {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'userPassword' => 'required|string',
        ]);

        $user = Auth::user();

        if (!$user) {
            throw ValidationException::withMessages(['message' => 'User not authenticated']);
        }
        $user->update([
            'userPassword' => Hash::make($request->userPassword),
        ]);
        return response()->json(['message' => 'Password reset successfully',]);
    }
    public function loginWithGoogle(Request $request)
    {
        $request->validate([
            'credential' => 'required|string',
        ]);

        $client = new Google_Client(['client_id' => env('GOOGLE_CLIENT_ID')]);
        $payload = $client->verifyIdToken($request->credential);

        if ($payload) {
            $userEmail = $payload['email'];
            $userName = $payload['name'];
            $googleId = $payload['sub'];

            $user = User::where('userEmail', $userEmail)->first();

            if ($user) {

                $user->update([
                    'google_id' => $googleId,
                ]);
            } else {

                $user = User::create([
                    'userName' => $userName,
                    'userEmail' => $userEmail,
                    'userPassword' => Hash::make(1),
                    'userAddress' => '',
                    'userPhoneNumber' => '',
                    'google_id' => $googleId,
                ]);
            }

            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'user' => $user->userId,
                'token' => $token,
            ], 200);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
}
