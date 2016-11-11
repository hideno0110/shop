<!DOCTYPE html>
<html lang="ja">
<head>
  <title>@yield('title')</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="/css/shop.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  <div class="container">
  <header>
    <div class="header-title">
      <a href="/shop"><h1>ショッピングサイト</h1></a>
    </div>
    <div class="header-right">
      @yield('header-right')    
    </div>
  </header>
  {{-- header end --}}
  @if(session('flash_message'))
    <p class="flash_message">{{ session('flash_message') }}</p>
  @endif

  <div class="main-wrapper">
    @yield('content')
  </div>
  {{-- main-wrapper end  --}}

  <footer>
    <p>&copy; NORI All Rights Reserved. </p>
  </footer>
  {{-- footer end  --}}
  </div>
</body>
</html>
