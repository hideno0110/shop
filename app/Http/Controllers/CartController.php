<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Cart;
use App\Item_stock;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
  public function index() {
    $carts = Cart::with('item')->get();
    $total_price = 0;
    foreach($carts as $cart) {
      $total_price += $cart->item->price * $cart->amount;
    }
    return view('shop.cart.index',['carts'=> $carts,'total_price'=>$total_price]);
  }

  public function update(Request $request, $id) {
    $cart = Cart::findOrFail($id);
    $cart->amount = $request->amount;
    $cart->save();
    return redirect('/shop/cart')->with('flash_message', '更新しました');
  }

  public function delete($id) {
    $cart = Cart::findOrFail($id);
    $cart->delete();
    return redirect('/shop/cart')->with('flash_message', '削除しました');
  }
  
  public function store(Request $request) {
    //viewへの受け渡し用
    $tmp_carts = Cart::with('item')->get();
    $total_price = 0;
    foreach($tmp_carts as $cart) {
      $total_price += $cart->item->price * $cart->amount;
    }

    //カートから商品を削除する 
    $carts = Cart::with('item');
    $carts->delete();

   //  return view('shop.cart.complete',['tmp_carts'=>$tmp_carts, 'total_price'=>$total_price])->with('flash_message', 'ご購入ありがとうございました');
      // -> このやり方だと、リロードした時に再度処理が走ってしまう。完了ページはリダイレクトさせる必要がある 
 
    //return redirect('/shop/cart/complete',['tmp_carts'=>$tmp_carts, 'total_price'=>$total_price])->with('flash_message', '削除しました');
    return redirect('/shop')->with('flash_message', 'ありがとうございました');;
      // -> The HTTP status code "1" is not valid.
     
  //  return Redirect::to('/shop/cart/complete', compact('tmp_carts','total_price'));
      // -> The HTTP status code "1" is not valid. 

  //  return redirect('/shop/cart/complete')->with(compact('tmp_carts','total_price'));
     // -> MethodNotAllowedHttpException in RouteCollection.php line 218:

  }
}
