<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class host extends Model
{
    use HasFactory;

    protected $table = 'host';

    protected $fillable = [
        "profile_image",
        "host_event_id",
        "host_name",
        "host_email",
        "host_occupation",
        "host_social",
    ];

    public function event()
    {
        return $this->belongsTo(events::class);
    }
}
