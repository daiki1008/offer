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
         <h1 class="logo">offer</h1>
         <!-- <img src="../../../../public/image/Offerlog.jpg"> -->
     </div>
     </header>

     <div class="nav-bar-area">
       <ul class="nav-ber">
         <li class="nav-btn-right" id="login_btn"><a href="{{ action('Guest\RegisterController@login') }}">LOGIN</a></li>
         <li class="nav-btn-right"><a href="{{ action('Guest\RegisterController@register') }}">SIGN UP</a></li>
       </ul>
     </div>

    <!-- ログイン画面 -->
    <main class="content">

     <!-- <div class="login_container" id="login-form-wrap">

       <div class="login-form-base row" id="login-form-base">

       <div class="cancel-btn-area">
       <div class="btn cancel-btn">
         <p class="cancel">×</p>
       </div>
     </div> -->

       <!-- <form class="login-form" class="{{ action('Admin\ProfileController@info') }}" method="post" enctype=""multipart/form-data""> -->

       <!-- <form method="POST" action="{{ route('login') }}">
         @csrf
         @if (count($errors) > 0)
               <ul>
                 @foreach($errors->all() as $e)
                     <li>{{ $e }}</li>
                 @endforeach
               </ul>
          @endif
        <div class="form-group login-mailaddress row">
          <label for="email">メールアドレス</label> -->


          <!-- <input type="email" id="login-mailaddress" name="mailaddress" class="form-control" value="{{ old('mailaddress') }}"> -->

          <!-- <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        </div>

        <div class="form-group login-password row">
          <label for="password">パスワード</label>
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        </div>

       <button type="submit" class="btn login-btn btn-primary" value="ログイン">
         {{ __('Login') }}
       </button>

         </form>
         </div>
     </div> -->

        <!-- ログイン画面 -->



          @yield('content')
        </main>

   </body>


   <footer class="footer-area">
   </footer>
</html>
