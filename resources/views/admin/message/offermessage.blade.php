@extends('layouts.admin')
@section('title','検索')
@section('content')

<div class="offer-page">
</div>


<div class="offer-form-wrap">

    <p class="offermessage">OFFERMESSAGE</p>
    <div class="received_offer_text" name="offer_text">
      <p class="message">{{ $userinfo['message'] }}</p>
    </div>
    <p class="tenpu">・添付ファイル</p>

    <button class="offer-submit" name="userinfo" >
      <p>承認する</p>
    </buttom>
    <button class="offer-submit" name="userinfo" >
      <p>見送る</p>
    </buttom>


</div>

@endsection
