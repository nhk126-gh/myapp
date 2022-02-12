<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Connect;
use App\Models\Product;

class ConnectController extends Controller
{
    public function find(Request $request)
    {
        // $items = Connect::all();
        // return view('product.index', ['items' => $items]);
        dd(Product::first()->before[0]->after);
    }
}
