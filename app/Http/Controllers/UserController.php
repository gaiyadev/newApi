<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function register(Request $request)
    {
        //validate incoming request 
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        try {
            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = $request->input('password');
            $user->save();
            //return successful response
            return response()->json(['user' => $user, 'message' => 'Account created successfully', 'status' => true], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Account Registration Failed!', 'status' => false], 409);
        }
    }
    // login 

    public function login(Request $request)
    {
        //validate incoming request 
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Username or Password is in valid'], 401);
        }
        return $this->respondWithToken($token);
    }
}
