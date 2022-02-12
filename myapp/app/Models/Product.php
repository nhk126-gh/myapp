<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;

    // public function before_connect()
    // {
    //     return $this->hasMany(Connect::class, 'before', 'code');
    // }

    // public function after_connect()
    // {
    //     return $this->hasMany(Connect::class, 'after', 'code');
    // }

    public function after()
    {
        return $this->belongsToMany(self::class, "connects", "before", "after");
    }

    public function before()
    {
        return $this->belongsToMany(self::class, "connects", "after", "before");
    }


}
