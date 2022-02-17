<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = [
        'supplier_code',
        'supplier_name'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'supplier_code', 'supplier_code');
    }
}
