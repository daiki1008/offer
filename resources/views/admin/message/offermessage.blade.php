@extends('layouts.admin')
@section('title','検索')
@section('content')

<div class="offer-page">
</div>


<div class="offer-form-wrap">

    <p class="offermessage">OFFERMESSAGE</p>
    <div class="offer_text" name="offer_text">
      {{ $userinfo['message'] }}
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
