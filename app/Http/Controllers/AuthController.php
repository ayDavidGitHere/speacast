<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('app', ['pageKey' => 'login', 'PAGE_TITLE' => 'Login to LaraPod']);
    }

    public function login(Request $request)
    { 
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed
            Auth::login(Auth::user()); // Log in the user

            return response()->json(['error' => -1, 'message' => 'Login successful', 'user' => Auth::user()]);
        } else {
            // Authentication failed
            return response()->json(['error' => 1, 'message' => 'Invalid credentials'], 401);
        }
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['error' => -1, 'message' => 'Logout successful']);
    }

    public function showRegistrationForm()
    {
        return view('app', ['pageKey' => 'register', 'PAGE_TITLE' => 'Register on LaraPod']);
    }

    public function register(Request $request)
    {   
        // Validate the registration data
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'firstName' => 'required',
            'lastName' => 'required',
        ]);
    
        if ($validator->fails()) {
            $error_code = 1;
            
            // Check if email already exists
            $existingUser = User::where('email', $request->input('email'))->first();
            if ($existingUser) {
                $error_code = 2;
            }
            // Check if username already exists
            $existingUser = User::where('username', $request->input('username'))->first();
            if ($existingUser) {
                $error_code = 3;
            }
    
            return response()->json(['error' => $error_code, 'message' => $validator->errors()], 422);
        }
    
        // Create a new user
        $user = new User;
        $user->name = "default";
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->firstName = $request->input('firstName');
        $user->lastName = $request->input('lastName');
        $user->save();
    
        // Log in the newly registered user
        Auth::login($user);
    
        return response()->json(['error' => -1, 'message' => 'Registration successful', 'user' => $user]);
    }
    
}
