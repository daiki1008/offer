@extends('layouts.guest')
@section('title','トップページ')
@section('content')

<div class="toppage_top">
  <div class="toppage_image">

   <div class="toppage_image_wrap">
     <!-- <img class="img1" src="{{ asset('image/1686623_s.jpg') }}">
     <img class="img2" src="{{ asset('image/1648206_s.jpg') }}">
     <img class="img3" src="{{ asset('image/2556275_m.jpg') }}"> -->
   </div>

</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>


    // ShowingImg = $('.toppage_image_wrap').children().first();
    // var SlideShow = setInterval(function(){
    //   $(ShowingImg).addClass('.toppage_img_active');
    //   $(ShowingImg).fadeIn();
    //   $(ShowingImg).fadeOut();
    //   $(ShowingImg).removeClass('.toppage_img_active');
    //   $(ShowingImg).next().addClass('.toppage_img_active');
    //   $(ShowingImg).next().fadeIn();
    //   ShowingImg = $(ShowingImg).next();
    // },1000);
    // setInterval(SlideShow,1000);
</script>



@endsection
