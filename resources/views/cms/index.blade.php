@extends('layouts.cms_default')

@section('title', 'shop管理ページ')

@section('content')

<div class="register-wrapper">  
  <h2>商品の登録</h2>
  
  @if(session('flash_message'))
    <p class="flash_message">{{ session('flash_message') }}</p>
  @endif
  
  <form method="post" action="{{ url('/cms') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <ul>
      <li>
        <label for="name">商品名：</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}">
        @if($errors->has('name'))
          <span class="error">{{ $errors->first('name')}}</span>
        @endif
      </li>
      <li>
        <label for="price">価格：</label>
        <input type="text" name="price" id="price" value="{{ old('price') }}">
        @if($errors->has('price'))
          <span class="error">{{ $errors->first('price')}}</span>
        @endif
      </li>
      <li>
        <label for="stock">在庫数：</label>
        <input type="text" name="stock" id="stock" value="{{ old('stock') }}">
        @if($errors->has('stock'))
          <span class="error">{{ $errors->first('stock')}}</span>
        @endif
      </li>
      <li>
        <label for="img">画像：</label>
        <input type="file" name="img" id="img" value="{{ old('img') }}">
        @if($errors->has('img'))
          <span class="error">{{ $errors->first('img')}}</span>
        @endif 
      </li>
      <li>
        <label for="status">ステータス</label>
        <select name="status" id="status" value="{{ old('status') }}">
          <option value="">選択してください</option>
          <option value="1">有効</option>
          <option value="0">無効</option>
        </select>
        @if($errors->has('status'))
          <span class="error">{{ $errors->first('status')}}</span>
        @endif
      </li>
      <li>
        <input type="submit" value="商品を登録する">
      </li>
    </ul>
  </form>
</div>
{{-- register end --}}

<div class="list-wrapper">
  <h2>商品情報の一覧・変更</h2>
  
  <table>
    <tr>
      <th>商品画像</th>
      <th>商品名</th>
      <th>価格</th>
      <th>在庫数</th>
      <th>ステータス</th>
      <th>操作</th>
    </tr>
    @foreach($items as $item)
    <tr>
      <td class="item_pic"><img src="/images/{{ $item->img }}"></td>
      <td class="item_price">{{ $item->name }}</td>
      <td class="item_name">{{ $item->price }}</td>
      <td class="item_stock">
        <form method="post" action="{{ action('CmsController@update', [$item->id, $name='stock']) }}"> 
          {{ method_field('patch') }}
          {{ csrf_field() }}
          <input type="text" name="stock" value="{!! $item->item_stock->stock !!}">個
          <input type="submit" value="変更する">
        </form>
      </td>
      <td class="item_status">@if($item->status == 0) 非公開 @else 公開中 @endif
        <form method="post" action="{{ action('CmsController@update', [$item->id, $name = 'status']) }}">
            {{ method_field('patch') }}
            {{ csrf_field() }}
            <input type="hidden" value="@if($item->status == 1)0 @else 1 @endif" name="status">
          <input type="submit" value="@if($item->status == 1)公開 -> 非公開 @else 非公開 -> 公開 @endif" id="status">
        </form>
      </td>
      <td class="item_delete">
       <form method="post" action="{{ action('CmsController@destroy', [$item->id]) }}" >
         {{ method_field('delete') }}
         {{ csrf_field() }}
         <input type="submit" value="削除">
       </form>
      </td>
    <tr>
    @endforeach
  </table>
</div>
{{-- list end --}}
@endsection
