@extends('layouts.shop_default')

@section('title', 'ショッピングサイト')
@section('header-right')
  <a href="/shop/cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
@endsection

@section('content')


  <div class="items_wrapper">

    <form action="{{ action('ShopController@index') }}" method="get">
      {{ csrf_field()  }}
      <input type="text" name="name" placeholder="商品名"> 
      <input type="submit" value="商品を検索する">
    </form>

    @foreach($items as $item) 
      <div class="item">
        <div class="item_pic"><img src="/images/{{ $item->img }}"></div>
        <div class="item_name">{{ $item->name }}</div>
        <div class="item_price">{{ number_format($item->price) }}円</div>
        <div class="item_cart">
          @if($item->item_stock->stock != 0)
            <form method="post" action="{{ action('ShopController@item_insert',[$item->id]) }}">
              {{ csrf_field() }}
              <input type="submit" value="カートに入れる"  id="button">
            </form>
          @else 
            <span class="sold">売り切れました</span>
          @endif
        </div>
      </div>
    @endforeach
    <div class="render">{!! $items->render() !!} </div>
  </div>
@endsection
