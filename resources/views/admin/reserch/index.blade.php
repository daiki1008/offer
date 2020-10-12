@extends('layouts.admin')
@section('title','検索')
@section('content')
<div class="main-container">

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


        <div class="reserch-btn">
          @csrf
          <input type="submit" class="btn btn-primary index-reserch-btn" value="Serch">
        </div>
      </form>
    </div>
  </div>

  <div class="index-table">
      @foreach($div_profiles as $profile)
      <a href="  {{ action('Admin\ProfileController@otherinfo',['id'=> $profile['id']]) }}  ">
        <div class="profile-index">


          <div class="index-image"><img src="{{ $profile['profile_image_path'] }}"></div>
          <div class="profile-index-head">
            <div class="index-name">{{ $profile['name'] }}</div>
            <div class="index-tag">{{ $profile['tag'] }}</div>
            <div class="index-introduction"><p>{{ $profile['introduction'] }}</p></div>
          </div>
          <div class="profile-index-function">
            <div class="index-favorite-btn"><a href="#">Favorite</a></div>
          </div>

        </div>
      </a>
      @endforeach

      <div class="page_area">
        @if($page > 1)
          <button class="index_prev_btn"><a href="  {{ action('Admin\ProfileController@reserchindex',['page_id'=> $page-1,'reserch' => $reserch,'tag' => $tag]) }}  ">←prev</a></button>
        @endif
        <div class="index_page">
          <p><?php echo $page ;?> / <?php echo $page_num ;?></p>
        </div>
        @if( $page < $page_num)
          <button class="index_next_btn"><a href="  {{ action('Admin\ProfileController@reserchindex',['page_id'=> $page+1,'reserch' => $reserch,'tag' => $tag]) }}  ">next→</a></button>
        @endif
      </div>

    </div>
</div>










@endsection
