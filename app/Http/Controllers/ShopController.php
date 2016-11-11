<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Item_stock;
use App\Cart;

class ShopController extends Controller
{

  public function index() {
    
    $items = Item::all()->where('status',1);
    return view('shop.index',['items'=>$items]);
  }

  public function item_insert(Request $request, $id) {

    //カートに追加する
    $cart = new Cart();
    $cart->item_id = $id;
    $cart->amount++;

    $cart->save();

    //在庫をマイナスする

    return redirect('/shop')->with('flash_message','カートに追加しました');
    
  }


}
