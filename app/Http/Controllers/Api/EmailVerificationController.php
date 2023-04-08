<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EmailVerificationController extends Controller
{
    public function verify(Request $request)
    {
        // Verify the email...

        $user = User::findOrFail($request->id);
        if ($request->hasValidSignature() && $user->email_verified_at === null) {
            $user->markEmailAsVerified();
            return Redirect::to('https://trial-tasker.vercel.app/login');
        }

        $now = new \DateTime();
        $user->email_verified_at = $now->format('d-m-Y H:i:s');
        //url de login de la app
        // return Redirect::to('http://localhost:3000/login');
        return Redirect::to('https://trial-tasker.vercel.app/login');
    }

    public function resend(Request $request)
    {
        // Resend the email verification notification...
        $request->user()->sendEmailVerificationNotification();

        return response()->json(['message' => 'Email verification link sent.'], 200);
    }
}
