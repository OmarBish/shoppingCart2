<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    protected $guarded = [];

    public function User()
    {
        return $this->belongsTo(User::Class);
        
    }
    public function products()
    {
        return $this->hasMany(product::Class);
    }
}
