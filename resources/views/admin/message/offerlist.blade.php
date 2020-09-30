@extends('layouts.admin')
@section('title','検索')
@section('content')


@foreach($userinfos as $userinfo)
  @if($userinfo->check == "0")
  <div class="profile-index" style="background-color:#FFF5EE ;">
  @elseif($userinfo->check == "1")
  <div class="profile-index" style="background-color:#FFFFF0 ;">
  @endif

    <a href="  {{ action('Admin\ProfileController@offermessage',['id'=> $userinfo->id,'message'=> $userinfo->message]) }}  ">

      <div class="index-image"><img src="{{ asset(  'storage/'.$userinfo->profile_image_path  ) }}"></div>
      <div class="profile-index-head">
          <div class="index-name">{{ $userinfo->name }}</div>
          <div class="index-tag">{{ $userinfo->tag }}</div>
          <div class="index-introduction">{{ $userinfo->message }}</div>
      </div>
      <div class="profile-index-function">

    <!-- <button type="button" class="favorite-btn" attr="{{ $userinfo->id }}" status="{{ $userinfo['status'] }}">
      <p>Favorite</p>
    </button> -->

  </div>
</a>
</div>

@endforeach
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>



</script>
@endsection
