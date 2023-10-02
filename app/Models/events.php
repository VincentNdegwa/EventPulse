<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class events extends Model
{
    use HasFactory;
    protected $fillable = [
        // events
        "title",
        "description",
        "deadline_application",
        "event_date",
        "category",
        "venue",
        "price",
        "creator_id",
        "address",
        "age_limit",
        "meeting_link",
        "event_image",

        // host
    ];

    public function hosts()
    {
        return $this->hasMany(host::class);
    }
}
