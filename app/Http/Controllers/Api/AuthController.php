<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\Correo;

class AuthController extends Controller
{

    // ------------------------register------------------------
    public function register(Request  $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string'],
                'lastname' => ['required', 'string'],
                'phone' => ['required', 'string'],
                'address' => ['required', 'string'],
                'email' => ['required', 'string', 'email', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            $user = User::create([
                'name' => $request->name,
                'lastname' => $request->lastname,
                'phone' => $request->phone,
                'address' => $request->address,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $correo = new Correo();
                 
            return response()->json([
                Mail::to($request->email)->send($correo),
                'message' => 'Registro exitoso',
            ], Response::HTTP_OK);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(["errors" => $e->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    // ------------------------login------------------------

    public function login(Request  $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('token')->plainTextToken;
            $cookie = cookie('auth_token', $token, 60 * 24);
            return response([
                'token' => $token,
                'is_admin' => $user->is_admin,
            ], Response::HTTP_OK)->withCookie($cookie);
        } else {
            return response()->json(["message" => 'Credenciales ninvalidas'], Response::HTTP_UNAUTHORIZED);
        }

    }

    // ------------------------userProfile------------------------

    public function userprofile(Request  $request)
    {
        $user = Auth::user(); 
        return response()->json([
            'message' => 'User Profile',
            'userData' =>$user,
        ], Response::HTTP_OK);
    }

    // ------------------------logout------------------------

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete(); 
        $cookie = Cookie::forget('auth_token');
        return response()->json([
            'message' => 'Sesion finalizada',
        ], Response::HTTP_OK)->withoutCookie($cookie);
    
    }

    // ------------------------allusers------------------------

    public function allusers()
    {
        return response()->json([
            'message' => 'metodo allusers ok'
        ]);
    }
}
