<!DOCTYPE html>
<html lang="ja">
<head>
  <title>@yield('title')</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>
  <div class="container">
  <header>
    <h1>SHOP管理ページ</h1>
  </header>
  {{-- header end --}}

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
