<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Connect extends Model
{
    use HasFactory;

    protected $primaryKey = ['before', 'after'];

    public $incrementing = false;

    protected $fillable = ['before', 'after'];

}
