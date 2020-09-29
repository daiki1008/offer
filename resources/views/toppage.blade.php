@extends('layouts.guest')
@section('title','トップページ')
@section('content')

<div class="toppage_top container">
 <!-- <img> -->
 <div class="text-white row">
   <div class="col-3">
     <!-- <p>プロフィール画像</p> -->
   </div>
   <div class="col-9">
     <img src="{{-- asset(Auth::user()->profile_image_path) --}}" alt="">
   </div>
   <div class="col-3">
     
   </div>
   <div class="col-9">

   </div>
 </div>
</div>





@endsection
