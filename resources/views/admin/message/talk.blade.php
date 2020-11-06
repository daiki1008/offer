@extends('layouts.admin')
@section('title','TALK')
@section('content')

<div class="talk_area">

  @foreach($allmessage as $talk)


    <div class="talk_block">
    @if($talk['sendUser_id'] == $user['id'])
      <div class="talk_box_right">
    @else
      <div class="talk_box_left">
    @endif
        <div class="user_image">
          <img src="{{ $talk['profile_image_path'] }}">
        </div>
        <div class="talk_content">
            <p class="talk_text">{{ $talk->message_content }}<p>
        </div>
        @if($talk->image_path !== "")
        <div class="file_check_message">
          <p class="tenpu">・添付ファイル   [ <a href="{{ $talk['image_path'] }}">{{ $talk['image_path']}}</a>  ]</p>
        </div>
        @endif
    </div>
  </div>

  @endforeach

</div>

<div class="replyarea">
  <textarea type="text" class="reply_text" name="reply_text"></textarea>
  <label for="uplodeFile" class="Image_uplode_label">
    <span class="Uplode_btn">画像を選択</span>
  <input id="uplodeFile" class="uplode_file" type="file" multiple="multiple" name="uplode_file[]">
  </label>
  <p></p>
</div>
<div class="reply_submit_area">
  <button class="reply-submit" name="userinfo" value="">
    <p>返信する</p>
  </buttom>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
$(function(){

$('.reply-submit').click(function(){

  $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
  });
  var receiveUserId = <?php echo  $userinfoId?>;
  var textData = $('.reply_text').val();
  var file =  document.getElementById("uplodeFile").files[0];
  alert(receiveUserId);


  var form = new FormData();

  form.append( "sendText", textData );
  form.append( "file", file );
  form.append( "receiveUserId", receiveUserId );


$.ajax({

    type: 'post',
    url: '/updateMessage',
    data: form,
    processData : false,
    contentType : false,

    //成功の場合、以下を行う。
    success: function(data){
        // window.location.reload();
        window.location.reload();
        // window.location.replace();
    },

    //失敗の場合、以下を行う。
    error : function(){
        alert('プロフィールを更新できませんでした。');
    }
});
});

// setTimeout(function(){
//    window.location.reload(1);
// }, 3000);


});
</script>

@endsection
