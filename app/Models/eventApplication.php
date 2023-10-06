<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class eventApplication extends Model
{
    use HasFactory;
    protected $table = "event_application";

    protected $fillable = [
        "user_id",
        "event_id",
        "event_agenda",
        "expectation",
        "similar_event",
        "learning_objective",
        "suggestions",
    ];

    public function event()
    {
        return $this->belongsTo(events::class);
    }

    public function user()
    {
        return     $this->belongsTo(users::class);
    }
}
