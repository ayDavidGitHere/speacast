<?php

// UserController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); 
        
        return view('app', ['pageKey' => 'show_users', 'PAGE_TITLE' => 'LaraPod Users']);
        return view('users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::find($id);

        return view('app', ['pageKey' => 'show_user', 'PAGE_TITLE' => 'LaraPod User']);
        return view('users.show', compact('user'));
    } 

    public function edit($id)
    {
        $user = User::find($id);

        return view('app', ['pageKey' => 'edit_user', 'PAGE_TITLE' => 'Edit LaraPod']);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->description = $request->input('description');
        // Update other user fields as needed
        $user->save();

        return redirect()->route('users.show', $user->id);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('users.index');
    }
}