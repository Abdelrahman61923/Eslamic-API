<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:6'],
            'device_name' => ['string', 'max:255'],
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $device_name = $request->post('device_name', $request->userAgent());
            $token = $user->createToken($device_name);

            return Response::json([
                'code' => 1,
                'token' => $token->plainTextToken,
                'user' => $user,
            ], 201);
        }

        return Response::json([
            'code' => 0,
            'message' => 'Invalid credentials',
        ], 401);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user = User::where('email', $request->email)->first();
        $device_name = $request->input('device_name', $request->userAgent());
        $token = $user->createToken($device_name);

        return response()->json([
            'message' => 'User registered successfully',
            'token' => $token->plainTextToken,
            'user' => $user,
        ], 201);
    }

    public function destroy($token = null)
    {
        $user = Auth::guard('sanctum')->user();

        if (null === $token) {
            $user->currentAccessToken()->delete();
        } else {
            $personalAccessToken = PersonalAccessToken::findToken($token);
            if ($user->id == $personalAccessToken->tokenable_id && get_class($user) == $personalAccessToken->tokenable_type) {
                $personalAccessToken->delete();
            }
        }
        return response()->json([
            'message' => 'User logged out successfully'
        ], 200);
    }

}
