<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate([
            'name'=>'required|string',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|confirmed'
        ]);

        $user = User::create([
            'name'=>$fields['name'],
            'email'=>$fields['email'],
            'password'=>bcrypt($fields['password'])

        ]);

        $token = $user->createToken('MyAppToken')->plainTextToken;

        $response = [
            'user'=>$user,
            'token'=>$token
        ];


        return Response($response,201);
    }

    public function login(Request $request){
        $fields=$request->validate([
            'email'=>'required|email',
            'password'=>'required|string'
        ]);

        // check email
        $user=User::where('email',$fields['email'])->first();

        // check password
        if(!$user || !Hash::check($fields['password'],$user->password)){
            return response(['message'=>'Wrong credentials'],401);
        }

        $token= $user->createToken('MyAppToken')->plainTextToken;

        $response = [
            'user'=>$user,
            'token'=>$token
        ];

        return response($response,200);

    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();

        return [
            'message'=>'Logged Out!'
        ];
    }
}
