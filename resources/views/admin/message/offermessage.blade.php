@extends('layouts.admin')
@section('title','検索')
@section('content')

<div class="offer-page">
<div class="offer-form-wrap">

    <div class="offermessage">
      <p>OFFERMESSAGE</p>
    </div>
    <div class="received_offer_text">
      <p class="message">{{ $message['message_content'] }}</p>
    </div>


    @if($message['image_path'] == "")
    <div class="file_check_area">
      <p class="tenpu">・添付ファイル なし</p>
    </div>
    @else
    <div class="file_check_area">
      <p class="tenpu">・添付ファイル   [ <a href="{{ $message['image_path'] }}">{{ $message['image_path']}}</a>  ]</p>
    </div>
    @endif

    <form class="choice" action="{{  action('Admin\ProfileController@choiceoffer',['userinfoId'=>$message['sendUser_id']]) }}" method="post">
      @csrf
      @if($message['receivedUser_id'] == $user['id'])
      <div class="approval_area">
        <button class="offer-submit-appropval" name="approval" value="0">
          <p>承認する</p>
        </buttom>
        <button class="offer-submit-pass" name="pass" value="1">
          <p>見送る</p>
        </buttom>
      </div>
      @endif
      @if($message['sendUser_id'] == $user['id'])
      <div class="attention_message">
        <p>OFFERが承認されるまでお待ちください</p>
      </div>
      @endif
    </form>

</div>
</div>

@endsection
