<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
  protected $fillable = ['name','price','status','img'];

  public function item_stock() {
    return $this->hasOne('App\Item_stock');
  }

  public function carts() {
    return $this->hasMany('App\Cart');
  }
}
