<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //dig()にてコピーした配列を入れるための配列
    public $connect_arr;
    //search_parent()にて親品番のProduct_addressを入れるための配列
    public $parent_adds = array();

    //部分検索
    public function search(Request $request)
    {
        $items = Product::where('address', 'like', '%' . $request->input . '%')
                        ->orWhere('supplier_code', 'like', '%' . $request->input . '%')
                        ->orWhere('hinban', 'like', '%' . $request->input . '%')
                        ->orWhere('seban', 'like', '%' . $request->input . '%')
                        ->orWhere('store', 'like', '%' . $request->input . '%')
                        ->orWhere('box_type', 'like', '%' . $request->input . '%')
                        ->get();
        return view('search', ['items' => $items]);
    }
    
    //工程検索
    public function process(Request $request)
    {
        //基準を1点取出す
        $item = Product::where('address', '=', $request->input)->first();
        // 基準が見つから無ければNotFoundを返す
        if (isset($item)) {
            //親品番確認
            $this->search_parent($item);
            if ($this->parent_adds[0] == $item->address){
                //親品番がなかった場合
                $result = $this->make_process($item);
                return view('process', ['items' => $result]);
            } else {
                //親品番があれば配列をforで回す
                //検索品番のidを渡す
                $id = $item->id;
                //重複削除
                $parent_adds_unique = array_unique($this->parent_adds);
                $results = array();
                foreach ($parent_adds_unique as $parent_add){
                    $item = Product::where('address', '=', $parent_add)->first();
                    $result = $this->make_process($item);
                    array_push($results, $result);
                }
                return view('processmany', ['results' => $results, 'id' => $id]);
            }
        } else {
            return view('process');
        }
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

    /**
     * 1つの製品から前工程を取得する
     *
     * @param  App\Models\Product  $item
     * 
     * @return array
     */
    public function make_process($item)
    {
        // 配列初期化
        $this->connect_arr = array();
        $items = $item->before;
        $this->dig($items, [$item]);
        // 配列をview用に変換
        $changed_arr = array();
        array_push($changed_arr, $this->connect_arr[0]);
        for ($i=1; $i < count($this->connect_arr); $i++){
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
        return $dist;
    }

    /**
     * 親品番有無確認
     *
     * @param  App\Models\Product  $item
     * 
     * @return void
     */
    public function search_parent($item)
    {
        $items = $item->after;
        if ($items->isEmpty()){
            array_push($this->parent_adds, $item->address);
            return;
        } else {
            foreach ($items as $item) {
                $this->search_parent($item);
            }
        }
    }

}
