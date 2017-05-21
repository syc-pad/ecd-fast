<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    public function categories()
    {
        return $this->belongsToMany('App\Category', 'quotes_categories');
    }
    
    public function getCreatedAtAttribute($value)
    {
        return strftime('%a %d %b %Y', strtotime($value));
    }
}
