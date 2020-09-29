@extends('layouts.admin')
@section('title','プロフィール')
@section('content')

<div class="profile-container">

   <div class="container-top-area">
       <div class="profile-image">
       <img src="{{ asset(  'storage/'.$userinfo['profile_image_path']  ) }}">
       </div>


       <div class="profile-top-area">
         <div class="user-name-area">
           <p class="profile_user_name">{{ $userinfo['name'] }}</p>
         </div>

       <!-- <div class="goverment-area">
          <h3 class="profile_goverment">{{ $user['yagou'] }}</h3>
        </div> -->

         <div class="job-tag-area">
           <p class="profile_job_tag">{{ $userinfo['tag'] }}</p>
         </div>
       </div>


       <button type="button" class="favorite-btn">
         <p>Favorite</p>
       </button>

       <button type="button" class="offer-btn">
         <a href="{{ action('Admin\ProfileController@offer',['id'=> $userinfo->id]) }}"><p>Offer</p></a>
       </button>

   </div>

   <div class="container-main-area">
     <h5 class="profile_text_top">Profile</h5>
       <div class="profile_text_area">
         <p class="profile_text">{{ $userinfo['introduction'] }}</p>
       </div>
   </div>

   <div class="container-gallary-area">

     <div class="profile_gallary_head">
      <h5 class="profile_gallary">Gallary</h5>
     </div>

     <div class="gallary_area">
       @foreach($images as $image)
       <img class="gallary_image" src="{{ asset(  'storage/'.$image->image_path  ) }}" alt="{{  $image['id'] }}">
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
  // ［検索］ボタンクリックで検索開始
   <?php  if( $favorite['status'] == 1) :?>
    $('.favorite-btn').addClass('fav-btn-change');
   <?php  elseif( $favorite['status'] == 0) :?>
    $('.favorite-btn').removeClass('fav-btn-change');
   <?php endif;?>

  $('.favorite-btn').click(function() {

    var id = <?php echo $userinfo['id']?>;
    var loginId = <?php echo $user['id']?>;
    var favorite = <?php echo $favorite['status']?>;


    $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: '/favorite/' + id,
    type: 'GET',
    id: id,
    data: {'id': {{ $userinfo['id'] }}, 'loginId': {{ $user['id'] }} },
    success: function(){
       if( $('.favorite-btn').hasClass('fav-btn-change') ) {
            $('.favorite-btn').removeClass('fav-btn-change');

         } else {
            $('.favorite-btn').addClass('fav-btn-change');
                }

          },
    error: function(){
            alert('失敗しました');
    }
  });
  });


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
