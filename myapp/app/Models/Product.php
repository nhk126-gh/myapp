<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = [
        'address',
        'supplier_code',
        'seban',
        'hinban',
        'quantity',
        'store',
        'box_type'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_code', 'supplier_code');
    }

    public function after()
    {
        // return $this->belongsToMany(self::class, "connects", "before", "after");
        return $this->hasManyThrough(self::class, Connect::class, "before", "address", "address", "after");
    }

    public function before()
    {
        // return $this->belongsToMany(self::class, "connects", "after", "before");
        return $this->hasManyThrough(self::class, Connect::class, "after", "address", "address", "before");
    }


}
