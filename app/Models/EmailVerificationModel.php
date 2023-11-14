<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailVerificationModel extends Model
{
    use HasFactory;
    protected $table = "email_verification";

    protected $fillable = [
        "email",
        "md5",
        "time",
        "deadline",
    ];
}
