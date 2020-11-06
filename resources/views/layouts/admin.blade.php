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
   </head>

   <body>
     <header class="header_area">
         <div class="top-area">
           <h1 class="logo">offer</h1>
           <!-- <img src="{{ asset('image/Offerlogo.jpg') }}"> -->
         </div>
     </header>

     <div class="velt"></div>


     <div class="nav-bar-area">
       <ul class="nav-ber">
         <li ><a class="nav-btn-right" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();"><span class="nav-btn-text">
             LOGOUT
           </span></a>
             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                 @csrf
             </form>
         </li>

         <li ><a class="nav-btn-right" href="{{ asset('admin/reserch/index') }}"><span class="nav-btn-text">SERCH</span></a></li>
       </ul>
     </div>


    <main class="content">
       <div class="side-menu">
         <div class="side-menu-content">
         <div class="side-menu-top">

            <div class="side-profile-image">
              <img src="{{ $user['profile_image_path']  }}">
            </div>

            <div class="side-profile">
              <div class="side-user-name">
                <p class="side-profile-text">{{ $user['name']}}</p>
              </div>

              <div class="side-job-tag">
                <p class="side-profile-text">{{ $user['tag'] }}</p>
              </div>
            </div>

         </div>

         <ul class="side-nav-area">
           <li class="side-nav"><a href="{{ action('Admin\ProfileController@info') }}" class="side-nav">MyPage</a></li>
           <li class="side-nav"><a href="{{ action('Admin\ProfileController@offerlist') }}" class="side-nav">Offer List</a></li>
           <li class="side-nav"><a href="{{ action('Admin\ProfileController@favoritelist') }}" class="side-nav">Favorite List</a></li>
           <li class="side-nav"><a href="{{ action('Admin\ProfileController@message') }}" class="side-nav">Message</a></li>
           <!-- <li class="side-nav"><a href="#" class="side-nav">Room</a></li> -->
         </ul>

         </div>
       </div>

       <div class="main-content">
          @yield('content')
       </div>

    </main>
    <footer class="footer-area">
    </footer>
   </body>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
   <script>
   $(function(){

     var height = $('.main-content').height();
     $('.side-menu').height(height);


   });
   </script>
</html>
