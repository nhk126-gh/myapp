<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public $connect_arr;

    public function findall(Request $request)
    {
        $items = Product::all();
        return view('find', ['items' => $items]);
    }

    public function search(Request $request)
    {
        $items = Product::where('code', 'like', '%' . $request->input . '%')->get();
        return view('find', ['items' => $items]);
    }

    public function dig($items, $arr)
    {
        if (!$items->isEmpty()) {
            foreach ($items as $item){
                $new_arr = $arr;
                array_push($new_arr, $item->id);
                $next = $item->after;
                $this->dig($next, $new_arr);
            }
        } else {
            array_push($this->connect_arr, $arr);
            return;
        }
    }

    public function connect(Request $request)
    {
        $this->connect_arr = array();
        $item = Product::find(1);

        if (isset($item)) {
            $items = $item->after;
        }else{
            return view('find');
        }

        $this->dig($items, [$item->id]);

        // return view('find', ['items' => $this->connect_arr]);
        dd($this->connect_arr);
    }
}
