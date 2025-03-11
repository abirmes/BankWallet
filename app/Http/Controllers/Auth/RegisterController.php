<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(RegisterationRequest $request)

    {

        $newuser = $request->validated();
        $newuser['password'] = Hash::make($newuser['password']);
        $newuser['role_id'] = 1;

        $user = User::create($newuser);

        $success['token'] = $user->createToken('user' , ['app:all'])->plainTextToken;
        $success['name'] = $user->first_name;
        $success['success'] = true;

        return response()->json($success , 200);

    }

}
