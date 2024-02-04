<?php

// app\Models\Profile.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'display_image_src',
        'email',
        'description',
        'episodes_released',
        'episodes_plays',
        'subscribed_totals',
        'followers_count',
        'following_count',
        // Add more fields here as needed
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        // You can specify casting for specific fields if needed
    ];
}
