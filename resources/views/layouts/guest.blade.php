<!DOCTYPE html>
<html lang="{{  app()->getLocale() }}">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width,initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <title>@yield('title')</title>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script src="{{ asset('js/app.js') }}" defer></script>
      <script src="{{ asset('js/offer.js') }}" defer></script>
      <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c&display=swap" rel="stylesheet">
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
      <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
   </head>

   <body>
     <header>
     <div class="top-area">

         <h1 class="logo"><a href="/">offer</a></h1>
         <!-- <img src="../../../../public/image/Offerlog.jpg"> -->
     </div>
     </header>

     <div class="nav-bar-area">
       <ul class="nav-ber">
         <li  id="login_btn"><a  class="nav-btn-right" href="{{ action('Guest\RegisterController@login') }}"><span class="nav-btn-text">LOGIN</span></a></li>
         <li><a class="nav-btn-right" href="{{ action('Guest\RegisterController@register') }}"><span class="nav-btn-text">SIGN UP</span></a></li>
       </ul>
     </div>

    <!-- ログイン画面 -->
    <main class="guest_content">


          @yield('content')
    </main>

   </body>


   <footer class="footer-area">
   </footer>
</html>
