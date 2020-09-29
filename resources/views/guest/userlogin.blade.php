@extends('layouts.guest')
@section('title','新規登録')
@section('content')

<div class="container">
  <div class="login-form-base row">

  <div class="cancel-btn-area">
  <div class="btn cancel-btn">
    <p class="cancel">×</p>
  </div>
</div>

  <form class="login-form" class="{{ action('Admin\ProfileController@create') }}" method="post" enctype=""multipart/form-data"">
    @if (count($errors) > 0)
          <ul>
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
          </ul>
     @endif
   <div class="form-group login-mailaddress row">
     <label>メールアドレス</label>
     <input type="text" id="login-mailaddress" name="mailaddress" class="form-control" value="{{ old('mailaddress') }}">
   </div>

   <div class="form-group login-password row">
     <label>パスワード</label>
     <input type="text" id="login-password" name="password" class="form-control" value="{{ old('password') }}">
   </div>

  <input type="submit" class="btn login-btn btn-primary" value="ログイン">
    </form>
    </div>
</div>

@endsection
