@extends('layouts.admin')
@section('title','検索')
@section('content')
<div class="main-container">
  <div class="profileEdit-top-area">

      <div class="edit-profile-image">
        <img id="edited-profile-image" src="{{ $user['profile_image_path']  }}">
      </div>
      <div class="edit_White_base"></div>

      <label for="profileImage_uplode" class="profileImage_uplode_label">
        <span class="fileUplode_btn">プロフィール画像を選択</span>
      <input id="profileImage_uplode" class="profileImage_uplode" type="file" multiple="multiple" name="profileImage_uplode">
      </label>

      <div class="editProfile-top-area">
        <input class="edit_name_area" value="{{ $user['name'] }}">
        <div class="text_underline"></div>
        <div class="edit-job-tag-area">
          <p class="edit_job_tag">{{ $user['tag'] }}</p>
        </div>
      </div>

  </div>

  <div class="profile-edit-area">
    <h5 class="edit_profile_text_top">プロフィールの編集</h5>
        <textarea class="edit_profile_text" name="edit_profile_text" rows="13" cols="90">
          {{ $user['introduction'] }}
        </textarea>
  </div>

  <button class="profile_update_btn">
    <p>プロフィールを更新</p>
  </button>


  <div class="uplode_form_area">
      <h5>ギャラリーの編集</h5>

      <!-- <input id="uplodeFile" class="uplode_file" type="file" multiple="multiple" name="uplode_file[]"> -->
      <!-- <p class="img-comment">コメント</p> -->
      <!-- <input id="imageComment" class="input-img-comment" type="text" name="comment"> -->
      <label for="uplodeFile" class="Image_uplode_label">
        <span class="Uplode_btn">画像を選択</span>
      <input id="uplodeFile" class="uplode_file" type="file" multiple="multiple" name="uplode_file[]">
      </label>
      <button  class="file-submit-btn" type="submit" >
        <p>UPLODE</p>
      </button>
      <a href="{{ action('Admin\ProfileController@info') }}"><p class="backto-mypage">マイページへ戻る</p></a>

      <div class="uplode_file_check">
        <img id="uplode_file_image1" src="E">
        <img id="uplode_file_image2" src="E">
        <img id="uplode_file_image3" src="E">
        <img id="uplode_file_image4" src="E">
      </div>

      @csrf
      <!-- </form> -->
  </div>

  <div class="container-editGallary-area">

    <div class="profile_editGallary_head">
     <h5 class="profile_gallary">Gallary</h5>
    </div>

    <div class="edit_gallary_area">

      @foreach($images as $image)
      <span class="gallary_div">
        <button class="delete-btn" value="{{  $image['id'] }}">
          <p class="delete">×</p>
        </button>
        <img class="gallary_image" src="{{ $image['image_path'] }}" alt="{{  $image['id'] }}">
      </span>
      @endforeach
    </div>
    <div class="page_area">
      @if($page > 1)
        <button class="index_prev_btn"><a href="  {{ action('Admin\ProfileController@gallary_edit',['page_id'=> $page-1]) }}  ">←prev</a></button>
      @endif
      <div class="index_page">
        <p><?php echo $page ;?> / <?php echo $page_num ;?></p>
      </div>
      @if( $page < $page_num)
        <button class="index_next_btn"><a href="  {{ action('Admin\ProfileController@gallary_edit',['page_id'=> $page+1]) }}  ">next→</a></button>
      @endif
    </div>

   <div class="gallary_modal_wrap">
     <div class="gallary_modal">
       <span class="gallary_modal_image">
       <img id="modal_image_prev" src=" ">
       </span>

       <div class="btn cancel-btn">
         <p class="cancel">×</p>
       </div>

       <div class="prev_btn">
         <button>←prev</button>
       </div>

       <div class="next_btn">
         <button>next→</button>
       </div>


     </div>
   </div>


  </div>

</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
$(function(){

  $('.profile_update_btn').click(function(){

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });

    var nameData = $(".edit_name_area").val();
    var profileText = $(".edit_profile_text").val();
    var fileData = document.getElementById("profileImage_uplode").files[0];

    // alert(fileData);
    var form = new FormData();

    form.append( "name", nameData );
    form.append( "profileText", profileText );
    form.append( "file", fileData );
    console.log(form);


    $.ajax({

        type: 'post',
        url: '/updateProfile',
        data: form,
        processData : false,
        contentType : false,

        //成功の場合、以下を行う。
        success: function(data){
            // window.location.reload();
            alert('プロフィールを更新しました。');
        },

        //失敗の場合、以下を行う。
        error : function(){
            alert('プロフィールを更新できませんでした。');
        }
    });
// }

  });






  $('#profileImage_uplode').change(function(){
    var fileDataElement = document.getElementById("profileImage_uplode").files[0];


    var reader = new FileReader();
    reader.readAsDataURL(fileDataElement);
    reader.onload = function(){
      $('#edited-profile-image').fadeOut();
      $('#edited-profile-image').attr('src', reader.result);
      $('#edited-profile-image').fadeIn();

    }
  });







    fileArray = [];
  $('#uplodeFile').change(function(){
    var fileDataElement = document.getElementById("uplodeFile");
    // var fileData1 = document.getElementById("uplodeFile").files[0];

    // alert(fileDataElement);

    var fileList = fileDataElement.files;
    var fileListnum = fileList.length;
    // alert(fileListnum);

    // var image0 = $('#uplode_file_image1');
    // var image1 = $('#uplode_file_image2');
    // var image2 = $('#uplode_file_image3');
    // var image3 = $('#uplode_file_image4');

    for (var i=0; i<fileListnum; i++){
       var selecta = "image"+i;
       check = fileList.item(i);
       fileArray.push(check);

    }

    // alert(fileArray[0]);
    // alert(fileArray[1]);
    // alert(fileArray[2]);
    // alert(fileArray[3]);

    // var form = new FormData();



    var reader1 = new FileReader();
    reader1.readAsDataURL(fileArray[0]);
    reader1.onload = function(){
      $('#uplode_file_image1').attr('src', reader1.result);
      $('#uplode_file_image1').fadeIn();

    }
    var reader2 = new FileReader();
    reader2.readAsDataURL(fileArray[1]);
    reader2.onload = function(){
      $('#uplode_file_image2').attr('src', reader2.result);
      $('#uplode_file_image2').fadeIn();

    }
    var reader3 = new FileReader();
    reader3.readAsDataURL(fileArray[2]);
    reader3.onload = function(){
      $('#uplode_file_image3').attr('src', reader3.result);
      $('#uplode_file_image3').fadeIn();

    }
    var reader4 = new FileReader();
    reader4.readAsDataURL(fileArray[3]);
    reader4.onload = function(){
      $('#uplode_file_image4').attr('src', reader4.result);
      $('#uplode_file_image4').fadeIn();
      // fileArray = [];
    }



  });





  $('.file-submit-btn').click(function(){
    alert(fileArray[0]);
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });

    // var textData = $("#imageComment").val();
    // var fileData = document.getElementById("uplodeFile").files[0];
    var form = new FormData();
    var fileArrayNum =  $(fileArray).length;
    // alert(fileArrayNum);

    for (var i=0;i<fileArrayNum;i++){
    // form.append( "text", textData );
    form.append( "file", fileArray[i] );
    console.log(fileArray[i]);


    $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
        type: 'post',
        url: '/updateGallary',
        data: form,
        processData : false,
        contentType : false,

        //成功の場合、以下を行う。
        success: function(data){
            window.location.reload();
        },

        //失敗の場合、以下を行う。
        error : function(){
            alert('アップロードする画像を洗濯してください。');
        }
    });
}


    // $('#uplode_file_image').attr('src',uplodeImage);
    // $('#uplode_file_image').show();
  });


  $('.gallary_div').hover(
    function(){
      $(this).find('button').show();
    },
    function(){
      $(this).find('button').hide();
   });


  $('.delete-btn').click(function(){
    var id = <?php echo $user['id']?>;
    var imageId = $(this).attr('value');

    $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: '/editGallary/' + id,
    type: 'GET',
    id: id,
    data: {'id': {{ $user['id'] }}, 'imageId': imageId },

    success: function(){
            window.location.reload();

          },
    error: function(){
            alert('削除できませんでした。');
    }
  });

  });


  $('.gallary_image').click(function(){
      imageUrl = $(this).attr('src');
      presentView = $(this).parent();

      $('#modal_image_prev').attr('src',imageUrl);
     $('.gallary_modal_wrap').fadeIn();
  });

  $('.next_btn').click(function(){
    $('#modal_image_prev').fadeOut(function(){
      imageUrl = $(presentView).next().find('img').attr('src');
      presentView = $(presentView).next();
        if(imageUrl == undefined){
          imageUrl = $('.gallary_div').first().find('img').attr('src');
          presentView = $('.gallary_div').first();
        }
      // alert(imageUrl);
    $('#modal_image_prev').attr('src',imageUrl);
    $('#modal_image_prev').fadeIn();
  });
  });


  $('.prev_btn').click(function(){
    $('#modal_image_prev').fadeOut(function(){
      imageUrl = $(presentView).prev().find('img').attr('src');
      presentView = $(presentView).prev();
      if(imageUrl == undefined){
        imageUrl = $('.gallary_div').last().find('img').attr('src');
        presentView = $('.gallary_div').last();
      }
    $('#modal_image_prev').attr('src',imageUrl);
    $('#modal_image_prev').fadeIn();

  });
  });

  $('.cancel-btn').click(function(){
  $('.gallary_modal_wrap').fadeOut();
  });





});
</script>





@endsection
