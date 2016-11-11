<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item_stock extends Model
{
  protected $fillable = [
    'item_id',
    'stock'
  ];
  
  public function item() {
    return $this->belongsTo('App\Item');
  }

}
