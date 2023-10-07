<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userProfile extends Model
{
    use HasFactory;
    protected $table = "user_profile";
    protected $fillable = [
        "first_name",
        "last_name",
        "phone_name",
        "country",
        "state",
        "profile_image",
        "user_profile_id"
    ];


    public function user()
    {
        return $this->belongsTo(users::class, 'user_profile_id', 'id');
    }
}
