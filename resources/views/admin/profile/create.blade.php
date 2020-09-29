
@extends('layouts.guest')
@section('title','新規登録')
@section('content')

<div class="container">
  <div class="form-base row">
  <form class="{{ action('Admin\ProfileController@create') }}" method="post" enctype="multipart/form-data">

    <h3>新規登録</h3>
    @if (count($errors) > 0)
          <ul>
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
          </ul>
     @endif

   <div class="form-group row">
     <label>ユーザーネーム</label>
     <input type="text"  name="user_name" class="form-control" value="{{ old('user_name') }}">
   </div>

   <div class="form-group row">
     <label>職業タグ</label>
     <input type="text"  name="tag" class="form-control" value="{{ old('tag') }}">
   </div>

   <div class="form-group row">
     <label>社名・屋号</label>
     <input type="text"  name="yagou"  class="form-control" value="{{ old('yagou') }}">
   </div>

   <div class="form-group input-profile row">
     <label>プロフィール</label>
     <textarea class="form-control" name="introduction" row="20">{{ old('profile') }}</textarea>
   </div>

   <div class="form-group input-profile-image row">
     <label>プロフィール画像</label>
     <input type="file" name="profile_image" class="form-control-file" >
   </div>


   <div class="form-group input-mailaddress row">
     <label>メールアドレス</label>
     <input type="text" name="mail_address" class="form-control" value="{{ old('mail_address') }}">
   </div>

   <div class="form-group input-password row">
     <label>パスワード</label>
     <input type="text" name="user_password" class="form-control" value="{{ old('user_password') }}">
   </div>

    @csrf

  <input type="submit" class="btn btn-primary" value="登録">
    </form>
    </div>
</div>

@endsection
