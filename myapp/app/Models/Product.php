<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_code', 'supplier_code');
    }

    public function after()
    {
        return $this->belongsToMany(self::class, "connects", "before", "after");
    }

    public function before()
    {
        return $this->belongsToMany(self::class, "connects", "after", "before");
    }


}
