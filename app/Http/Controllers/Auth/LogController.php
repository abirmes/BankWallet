<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class LogController extends Controller
{
    public function login(Request $request){
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(auth()->attempt($credentials))
        {
            $user = FacadesAuth::user();

            $user->tokens()->delete();

            $success['token'] = $user->createToken(request()->userAgent())->plainTextToken;

            $success['name'] = $user->first_name;
            $success['success'] = true;
            return response()->json($success , 200);
        }
        else{
            return response()->json(['error' => 'unauthorised',401]);
        }
    }
}
