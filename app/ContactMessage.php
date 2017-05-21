<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    public function getCreatedAtAttribute($value)
    {
        return strftime('%a %d %b %Y', strtotime($value));
    }
}
