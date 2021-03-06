@extends('layouts.admin')
@section('title','検索')
@section('content')

<div class="offer-page">
</div>


<div class="offer-form-wrap">
  @if($user->id == $userinfoId)
  <div class="offerpage_error">
    <p>自分にはオファーを送れません</p>
  </div>
  @endif
  @if($user['id'] !== $userinfoId)
  <form class="offer-send-form" action="{{ action('Admin\ProfileController@sendoffer') }}" method="post" enctype="multipart/form-data">
    @csrf
    <p class="offermessage">OFFERMESSAGE</p>
    <ul class="offer-attention">
       <li>・OFFERしたい仕事の内容についてできるだけ詳しく書いてください。</li>
       <li>・OFFERメッセージが承認されると、メッセージのやりとりができるようになります。</li>
       <li>・OFFERしたい仕事と関係ない内容は控えてください。</li>
    </ul>
    <textarea type="text" class="offer_text form-group" name="offer_text"></textarea>
    <p class="tenpu">・添付ファイル</p>
    <input type="file" name="offer-image" class="offer-image">
    <button class="offer-submit" name="userinfo" value="{{ $userinfoId }}">
      <p>OFFERする</p>
    </buttom>

  </form>
  @endif
</div>

@endsection
