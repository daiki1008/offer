@extends('layouts.admin')
@section('title','検索')
@section('content')

<div class="index-table">
  @foreach($userinfos as $userinfo)
  <div class="profile-index">
      <a href="  {{ action('Admin\ProfileController@talk',['id'=> $userinfo->id,'message'=> $userinfo->message,'check'=> $userinfo->check]) }}  ">

        <div class="index-image"><img src="{{ asset(  $userinfo['profile_image_path']  ) }}"></div>
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
 </div>

@endsection
