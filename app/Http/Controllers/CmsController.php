<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Item_stock;
use DB;

class CmsController extends Controller
{
  public function index() {

//    SQLログ出力確認用
//    DB::connection()->enableQueryLog();
//    $items = Item::find(1)->item_stock;
//    $q = DB::getQueryLog();
//    echo "<pre>";
//    var_dump($q);
    
    //この方法で取得すると、レコードごとにSQLが走るのでよくない
    //$items = Item::all();
    //foreach ($items as $item) {
    //  $item->item_stock;
    //}      

    $items = Item::with('item_stock')->get();

   // foreach($items as $item) {
   //   print $item->item_stock->stock;
  //  }

    return view('cms.index',['items'=>$items]);
  
  }
  
  public function store(Request $request) {

    $this->validate($request, [
      'name'=>'required',
      'price'=>'required|regex:/^[0-9]+$/',
      'stock'=>'required|regex:/^[0-9]+$/',
      'img'=>'required|mimes:jpg,jpeg,gif,png',
      'status'=>'required'
    ]);

      DB::transaction(function() use ($request)
      {
        try {
          $item = new Item();
          $item->name = $request->name;
          $item->price = $request->price;
          $item->status = $request->status;

          $file = $request->file('img');
          $filename = $file->getClientOriginalName();
          $file->move(public_path('images'), $filename);
          $item->img = $filename;
          $item->save();

          $stock = new Item_stock();
          $stock->item_id = $item->id;
          $stock->stock = $request->stock;
          $stock->save();
          DB::commit();
        } catch (Exception $e) {
          DB::rollback();
          return Redirect::back(); 
        };
      }
      );

    return redirect('/cms')->with('flash_message', '登録完了');
  }

  public function destroy($id) {

    $item = Item::findOrFail($id);
    $item->delete();
    
    return redirect('/cms')->with('flash_message', '削除しました');
  }

  public function update(Request $request, $id, $name) {

    $item = Item::findOrFail($id);


    if($name == 'status') { //商品公開フラグの更新の場合
      $item->status = $request->status;
      $item->save();
    
    }elseif($name == 'stock'){ //在工数を変更の場合
      //SQLログ出力確認用
      //DB::connection()->enableQueryLog();
      $item = $item->item_stock()->where('item_id',$id)->first();
      //$q = DB::getQueryLog();
      //echo "<pre>";
      //var_dump($q);
      //最初にfirstが必要で最後の保存にはfirstが必要ない理由がわからない 
      
      // $item_stock = Item_stock::whereItem_id($id);
     // dd($item_stock->stock);
      $item->stock = $request->stock;
      $item->save(); 


    }else{

    }
    
    
    return redirect('/cms')->with('flash_message','ステータスを更新しました');
  }
  
}
