<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Item_stock;
use App\Cart;
use Illuminate\Support\Facades\Input;

class ShopController extends Controller
{

  public function index() {

    $name = Input::get('name');
    $query = Item::query();

    if(!empty($name)){
      $query->where('name','like','%'.$name.'%');
    } 
    
    //Item::all()->where('status',1);
    $items = $query->orderBy('id','desc')->paginate(6);;

    // $items = Item::where('status',1)->orderBy('id', 'desc')->get();
    return view('shop.index',['items'=>$items]);
  }

  public function item_insert(Request $request, $id) {

    //カートに追加する
    $cart = new Cart();
    $cart->item_id = $id;
    $cart->amount++;

    $cart->save();

    //在庫をマイナスする
    // $item = Item::findOrFail($id);

    return redirect('/shop')->with('flash_message','カートに追加しました');
    
  }


}
