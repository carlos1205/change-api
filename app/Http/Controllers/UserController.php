<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\RegistersUsers;

class UserController extends Controller
{
    public function create(Request $request){
        if(User::where('email', $request->email)->exists()){
            return response()->json([
                "message" => "User already created."
            ], 409);   
        }

        $user = User::create([
            'name' => $request -> name,
            'email' => $request -> email,
            'pass' => Hash::make($request -> password),
            'api_token' => Str::random(60),
        ]);

        return response()->json([
            "message" => "User created.",
            "id" => $user -> id
        ], 201);
    }
    
    public function login(Request $request){
        $user = self::get($request -> email);
        if(Hash::check($request -> password, $user -> pass)){
            return response()->json([
                "id" => $user -> id,
                "token" => $user -> api_token
            ], 200);
        }else{
            return response()->json([
                "message" => "Email or password is wrong."
            ], 404);
        }
    }

    private function get($email){
        $user = User::where('email', $email)->get()->first();
        return $user;
    }

    public function update(Request $request, $id){
        $user = User::find($id);
        $user -> name = $request -> name;
        $user -> email = $request -> email;
        $user -> pass = $request -> pass;
        $user -> save();

        return response()->json($user, 200);        
    }

    public function delete($id){
        $user = User::find($id);
        if(!$user->exists()){
            return response()->json([
                "message" => "User don't exists."
            ], 404);
        }

        $user->delete();
        return response()->json([
            "message" => "User deleted."
        ], 200);
    }
}
