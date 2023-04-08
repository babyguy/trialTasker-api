<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\Correo;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    // ------------------------register------------------------
    public function register(Request  $request):JsonResponse
    {
        // $request->confirmation_code =  Str::random(24);
        try {
            $request->validate([
                'name' => ['required', 'string'],
                'lastname' => ['required', 'string'],
                'phone' => ['required', 'string'],
                'address' => ['required', 'string'],
                'email' => ['required', 'string', 'email', 'unique:users,email'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'confirmation_code' => ['nullable'],
            ]);

            

            $user = User::create([
                'name' => $request->name,
                'lastname' => $request->lastname,
                'phone' => $request->phone,
                'address' => $request->address,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'confirmation_code' => $request->confirmation_code,
            ]);
            
            // $data = [
            //     'email'=>$user->email,
            //     'name' =>$user->name, 
            //     'confirmation_code'=> $user->confirmation_code
            // ];

            // Mail::send('correo', $data, function ($messsge) use ($data){
            //     $messsge->to($data['email'], $data['name'],)->subject('confirma tu correo');
            // });

            $user->sendEmailVerificationNotification();

            return response()->json([
                'message' => 'Registro exitoso',
            ], Response::HTTP_OK);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Registro fallido',
                "errors" => $e->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    // ------------------------login------------------------

    public function login(Request  $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string','email'],
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

    // ------------------------verify email------------------------

    public function verifyemail()
    {
        $user = Auth::user(); 

        // $data = [
        //     'email'=>$user->email,
        //     'name' =>$user->name, 
        //     'confirmation_code'=> $user->confirmation_code
        // ];

        // Mail::send('correo', $data, function ($messsge) use ($data){
        //     $messsge->to($data['email'], $data['name'],)->subject('confirma tu correo');
        // });
        $user->sendEmailVerificationNotification();

        return response()->json([
            'message' => 'correo de verificacion eviado'
        ],Response::HTTP_OK);
    }

    // ------------------------verify user------------------------
    // public function verifyuser($code){
    //     $user = User::where('confirmation_code',$code)->first();
    //     if(! $user){
    //         return response()->json(['message' => 'usuario no encontrado'],Response::HTTP_UNAUTHORIZED);
    //     }
    //     $user->confirmed = true;
    //     $user->email_verified_at = datetime();
    //     $user->save();
    // }
}
