<?php

// ProfileController.php
namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function get($username)
    {
        // Check if username already exists
        $user = User::where('username', $username)->first(); 
        if(!$user) {
            // Return the profile data as JSON response
            return response()->json(["error" => 1, "message" => "cannot find user"]);
        }

        // Get the user's profile data from the database based on their email
        $profile_data = Profile::where('email', $user->email)->first();

        // If profile data is not found, create a new profile with mock data
        if (!$profile_data) {
            $profile_data = $this->createMockProfile($user);
        }

        // Return the profile data as JSON response
        return response()->json(["error" => -1, "value" => $profile_data]);
    }

    private function createMockProfile($user)
    {
        $email = $user->email;

        // Create a new profile with mock data
        return Profile::create([
            'name' => $user->firstName . " " .  $user->lastName,
            'display_image_src' => 'https://loremflickr.com/320/240?lock=30976',
            'email' => $email,
            'description' => 'Hey there I use LaraPod',
            'episodes_released' => 0,
            'episodes_plays' => '0',
            'subscribed_totals' => '0',
            'followers_count' => 0,
            'following_count' => 0,
        ]);
    }

    public function update_meta(Request $request, $username)
    {
        // Check if username already exists
        $user = User::where('username', $username)->first(); 
        if (!$user) {
            // Return an error response if user not found
            return response()->json(["error" => 1, "message" => "Cannot find user"]);
        }

        // Get the user's profile data from the database based on their email
        $profile = Profile::where('email', $user->email)->first();

        // If profile data is not found, create a new profile
        if (!$profile) {
            $profile = $this->createMockProfile($user);
        }

        // Update the profile with new data
        $profile->update([ 
            'name' => $request->input('name'),
            'description' => $request->input('description') ?? $user->description,
        ]);

        // Return success response
        return response()->json(["error" => -1, "message" => "Profile updated successfully", "value" => $profile]);
    }
}
