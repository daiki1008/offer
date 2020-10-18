@extends('layouts.admin')
@section('title','検索')
@section('content')

<div class="offer-page">
<div class="offer-form-wrap">

    <p class="offermessage">OFFERMESSAGE</p>
    <div class="received_offer_text">
      <p class="message">{{ $message['message_content'] }}</p>
    </div>

    <div class="file_check_area">
      <p class="tenpu">・添付ファイル{{ $message['image_path']}}</p>
    </div>

    <div class="approval_area">
      <button class="offer-submit-appropval" name="approval" >
        <p>承認する</p>
      </buttom>
      <button class="offer-submit-pass" name="pass" >
        <p>見送る</p>
      </buttom>
    </div>


</div>
</div>

@endsection
