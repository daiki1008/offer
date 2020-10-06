@extends('layouts.admin')
@section('title','プロフィール')
@section('content')

<div class="profile-container">

   <div class="container-top-area">
       <div class="profile-image">
       <img src="{{ $user['profile_image_path'] }}">
       </div>

       <div class="edit-btn"><a href="{{ action('Admin\ProfileController@gallary_edit')}}">MyPageを編集</a></div>

       <div class="profile-top-area">
         <div class="user-name-area">
           <p class="profile_user_name">{{ $user['name'] }}</p>
         </div>

       <!-- <div class="goverment-area">
          <h3 class="profile_goverment">{{ $user['yagou'] }}</h3>
        </div> -->

         <div class="job-tag-area">
           <p class="profile_job_tag">{{ $user['tag'] }}</p>
         </div>
       </div>
   </div>

   <div class="container-main-area">
     <h5 class="profile_text_top">Profile</h5>
       <div class="profile_text_area">
         <p class="profile_text">{{ $user['introduction'] }}</p>
       </div>
   </div>

   <div class="container-gallary-area">

     <div class="profile_gallary_head">
      <h5 class="profile_gallary">Gallary</h5>
      <div class="edit-btn">
         <!-- <a href="{{ action('Admin\ProfileController@gallary_edit')}}">ギャラリーを編集</a> -->
      </div>
     </div>

     <div class="container-gallary-area">

       <div class="gallary_area">
         @foreach($images as $image)
         <img class="gallary_image" src="{{ asset(  $image['image_path']  ) }}" alt="{{  $image['id'] }}">
         @endforeach
       </div>

      <div class="gallary_modal_wrap">
        <div class="gallary_modal">
          <span class="gallary_modal_image">
          <img id="modal_image_prev" src=" ">
          </span>

          <div class="btn cancel-btn">
            <p class="cancel">×</p>
          </div>

          <div class="prev_btn">
            <button>←prev</button>
          </div>

          <div class="next_btn">
            <button>next→</button>
          </div>


        </div>
      </div>


     </div>

  </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
$(function() {

  $('.gallary_image').click(function(){
      imageUrl = $(this).attr('src');
      presentView = $(this);

      $('#modal_image_prev').attr('src',imageUrl);
     $('.gallary_modal_wrap').fadeIn();
  });

  $('.next_btn').click(function(){
    $('#modal_image_prev').fadeOut(function(){
      imageUrl = $(presentView).next().attr('src');
      presentView = $(presentView).next();
        if(imageUrl == undefined){
          imageUrl = $('.gallary_image').first().attr('src');
          presentView = $('.gallary_image').first();
        }
      // alert(imageUrl);
    $('#modal_image_prev').attr('src',imageUrl);
    $('#modal_image_prev').fadeIn();
  });
  });


  $('.prev_btn').click(function(){
    $('#modal_image_prev').fadeOut(function(){
      imageUrl = $(presentView).prev().attr('src');
      presentView = $(presentView).prev();
      if(imageUrl == undefined){
        imageUrl = $('.gallary_image').last().attr('src');
        presentView = $('.gallary_image').last();
      }
    $('#modal_image_prev').attr('src',imageUrl);
    $('#modal_image_prev').fadeIn();

  });
  });

  $('.cancel-btn').click(function(){
  $('.gallary_modal_wrap').fadeOut();
  });





});
</script>

@endsection
