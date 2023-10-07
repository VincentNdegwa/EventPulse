<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    use HasFactory;
    protected $fillable = [
        "time_registerd",
        "username",
        "email",
        "password",
    ];
    protected $hidden = [
        'password',
    ];


    public function Application()
    {
        return $this->hasMany(eventApplication::class, "user_id");
    }


    public function profile()
    {
        return $this->hasOne(userProfile::class, 'user_profile_id', 'id');
    }
}
