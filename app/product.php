<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(cart::Class);
    }
}
