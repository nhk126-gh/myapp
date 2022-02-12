<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Connect extends Model
{
    use HasFactory;
    public $timestamps = false;

    // public function product_before()
    // {
    //     return $this->belongsTo(Product::class, 'before', 'code');
    // }

    // public function product_after()
    // {
    //     return $this->belongsTo(Product::class, 'after', 'code');
    // }

}
