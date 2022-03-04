<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Response;
use Input;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    function register(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        $user = new User();

        $user->name = $name;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->save();
        return response($user)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'X-Header-One' => 'Header Value'
            ]);
    }

    function login(Request $request)
    {
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));

        $validator = Validator::make($request->all(), [ 
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = new User();
            $user = $user->where('email', $email)->first();
            return response()->json($user);
        } else {
            return response()->json($validator->errors(), 400);
        }
    }
}
