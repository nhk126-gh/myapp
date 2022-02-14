<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public $connect_arr;

    //全検索
    public function findall(Request $request)
    {
        $items = Product::all();
        return view('findall', ['items' => $items]);
    }

    //品番検索
    public function search(Request $request)
    {
        $items = Product::where('hinban', 'like', '%' . $request->input . '%')->get();
        return view('search', ['items' => $items]);
    }
    
    //前工程検索
    public function process(Request $request)
    {
        // 配列初期化
        $this->connect_arr = array();
        $changed_arr = array();

        //基準を1点取出す
        $item = Product::find($request->input);

        // 基準が見つかれば前工程検索
        // 無ければNotFoundを返す
        if (isset($item)) {
            $items = $item->before;
            $this->dig($items, [$item]);
        }else{
            return view('process');
        }

        // 配列をview用に変換
        array_push($changed_arr, $this->connect_arr[0]);
        for ($i=1; $i<count($this->connect_arr); $i++){
            $buf = $this->change_array($this->connect_arr[$i-1], $this->connect_arr[$i]);
            array_push($changed_arr, $buf);
        }

        //配列の要素数をそろえる
        $counts = array_map(function ($item) {
                    return count($item);
                }, $changed_arr);
        $max_count = max($counts);
        $dist = array_map(function ($item) use($max_count) {
                    return array_pad($item, $max_count, 'x');
                }, $changed_arr);

        return view('process', ['items' => $dist]);
    }

    /**
     * 前工程(子品番)検索
     *
     * @param  Illuminate\Support\Collection  $items
     * @param  array  $arr
     * @return void
     */
    public function dig($items, $arr)
    {
        if (!$items->isEmpty()) {
            foreach ($items as $item){
                $new_arr = $arr;
                array_push($new_arr, $item);
                $next = $item->before;
                $this->dig($next, $new_arr);
            }
        } else {
            array_push($this->connect_arr, $arr);
            return;
        }
    }

    /**
     * 配列変換
     *
     * @param  array  $arr1
     * @param  array  $arr2
     * @return array
     */
    public function change_array($arr1, $arr2)
    {
        $count_lim = min(count($arr1), count($arr2));
        $i = 0;
        //前の配列と比較して重複している値は'L'に置き換える
        while ($i < $count_lim){
            if ($arr1[$i] != $arr2[$i]){
                break;
            }
            $arr2[$i] = 'L';
            $i++;
        }
        //最後以外'L'を'-'に変換
        for ($i=0; $i < count($arr2) - 1; $i++){
            if ($arr2[$i + 1] == 'L'){
                $arr2[$i] = '-';
            }
        }
        
        return $arr2;
    }

}
