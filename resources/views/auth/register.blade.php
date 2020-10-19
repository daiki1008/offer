@extends('layouts.guest')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                          <label>職業タグ</label>

                          <ul class="checkbox-area">
                            <li class="checkbox"><input type="checkbox" name="tag[]" value="写真業">写真業</li>
                            <li class="checkbox"><input type="checkbox" name="tag[]" value="映像業">映像業</li>
                            <li class="checkbox"><input type="checkbox" name="tag[]" value="スタイリスト">スタイリスト</li>
                            <li class="checkbox"><input type="checkbox" name="tag[]" value="ヘアメイク">ヘアメイク</li>
                            <li class="checkbox"><input type="checkbox" name="tag[]" value="CGデザイナー">CGデザイナー</li>
                            <li class="checkbox"><input type="checkbox" name="tag[]" value="イラストレーター">イラストレーター</li>
                            <li class="checkbox"><input type="checkbox" name="tag[]" value="照明">照明</li>
                          </ul>
                        </div>

                        <!-- <div class="form-group row">
                          <label>社名・屋号</label>
                          <input type="text"  name="yagou"  class="form-control" value="{{ old('yagou') }}">
                        </div> -->

                        <div class="form-group input-profile row">
                          <label>プロフィール</label>
                          <textarea class="form-control" name="introduction" row="20">{{ old('introduction') }}</textarea>
                        </div>

                        <div class="form-group input-profile-image row">
                          <label>プロフィール画像</label>
                          <input type="file" name="profile_image_path" >
                        </div>


                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
