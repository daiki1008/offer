@extends('layouts.admin')
@section('title','お気に入り')
@section('content')
<div class="main-container">
  <div class="favoritelist-page"><p>お気に入りユーザーリスト</p></div>
  <div class="index-table">
    @if($userinfos == [] )
      <div class="favoritelist-page"><p>お気に入りユーザーはいません</p></div>
      @endif


      @foreach($userinfos as $userinfo)

      <div class="profile-index">
        <a href="  {{ action('Admin\ProfileController@otherinfo',['id'=> $userinfo->id]) }}  ">

          <div class="index-image"><img src="{{  $userinfo['profile_image_path']   }}"></div>
          <div class="profile-index-head">
            <div class="index-name">{{ $userinfo->name }}</div>
            <div class="index-tag">{{ $userinfo->tag }}</div>
            <div class="index-introduction">{{ $userinfo->introduction }}</div>
          </div>

        </a>
        <div class="profile-index-function">
          <button type="button" class="list-favorite-btn" attr="{{ $userinfo->id }}" status="{{ $userinfo['status'] }}">
            <p>Favorite</p>
          </button>
        </div>
      </div>


      @endforeach
    </div>

    <div class="page_area">
      @if($page > 1)
        <button class="index_prev_btn"><a href="  {{ action('Admin\ProfileController@favoritelist',['page_id'=> $page-1]) }}  ">←prev</a></button>
      @endif
      <div class="index_page">
        <p><?php echo $page ;?> / <?php echo $page_num ;?></p>
      </div>
      @if( $page < $page_num)
        <button class="index_next_btn"><a href="  {{ action('Admin\ProfileController@favoritelist',['page_id'=> $page+1]) }}  ">next→</a></button>
      @endif
    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
$(function() {
  // ［検索］ボタンクリックで検索開始
   // alert("e");

  if($('.list-favorite-btn').attr('status') == 1){
    $('.list-favorite-btn').addClass('fav-btn-change');
  }else if($('.list-favorite-btn').attr('status') == 0){
    $('.list-favorite-btn').removeClass('fav-btn-change');
  }



  $('.list-favorite-btn').click(function() {

    var id = $(this).attr('attr');
    var loginId = <?php echo $user['id']?>;
    var favorite = $(this).attr('status');
    This = $(this);



    $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: '/favorite/' + id,
    type: 'GET',
    id: id,
    data: { 'id':id, 'loginId': {{ $user['id'] }} } ,
    success: function(){
       if( $(This).hasClass('fav-btn-change') ) {
            $(This).removeClass('fav-btn-change');

         } else {
            $(This).addClass('fav-btn-change');
                }

          },
    error: function(){
            alert('失敗しました');
    }
  });


  });
});
</script>
@endsection
