@extends('layouts.admin')
@section('title','検索')
@section('content')

<div class="reserch-area">
 <div class="inner-reserch-area">
 <form class="reserch-form "action="{{ action('Admin\ProfileController@reserchindex')}}" method="post">
    <div class="reserch-box col-md-6">
      <input type="text" class="form-control" name="reserch">
    </div>

    <ul class="checkbox-area">
      <li class="checkbox"><input type="checkbox" name="tag[]" value="写真業">写真業</li>
      <li class="checkbox"><input type="checkbox" name="tag[]" value="映像業">映像業</li>
      <li class="checkbox"><input type="checkbox" name="tag[]" value="スタイリスト">スタイリスト</li>
      <li class="checkbox"><input type="checkbox" name="tag[]" value="ヘアメイク">ヘアメイク</li>
      <li class="checkbox"><input type="checkbox" name="tag[]" value="CGデザイナー">CGデザイナー</li>
      <li class="checkbox"><input type="checkbox" name="tag[]" value="イラストレーター">イラストレーター</li>
      <li class="checkbox"><input type="checkbox" name="tag[]" value="照明">照明</li>
    </ul>
 <!-- </div> -->

    <div class="reserch-btn">
       @csrf
     <input type="submit" class="btn btn-primary index-reserch-btn" value="Serch">
    </div>
 </form>
</div>

</div>

<div class="index-table">
    @foreach($profiles as $profile)
  <a href="  {{ action('Admin\ProfileController@otherinfo',['id'=> $profile->id]) }}  ">
  <div class="profile-index">


        <div class="index-image"><img src="{{ asset(  'storage/'.$user->profile_image_path  ) }}"></div>
     <div class="profile-index-head">
        <div class="index-name">{{ $profile->name }}</div>
        <div class="index-tag">{{ $profile->tag }}</div>
        <div class="index-introduction">{{ $profile->introduction }}</div>
     </div>
     <div class="profile-index-function">
        <div class="index-favorite-btn"><a href="#">Favorite</a></div>
        <div class="index-offer-btn"><a href="#">Offer</a></div>
      </div>

  </div></a>
    @endforeach
</div>











@endsection