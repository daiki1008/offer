<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Image;
use App\Favorite;
use App\Message;
use App\Offer;
use Illuminate\Support\Facades\Auth;
use Storage;
use Log;

class ProfileController extends Controller
{

     public function add(){
       return view('auth.register');
     }

     public function info(Request $request){
        $id = Auth::user()->id;
        $user = User::find($id);
        // dd($user->profile_image_path);

        $images0 = Image::where('user_id', 'like', $id)->orderBy("images.id", "DESC")->get();
        $images0->sortByDesc('id');

        // dd($favorite);
        define('MAX','24');
        $ArrayLength = count($images0);
        $page_num = ceil($ArrayLength/MAX);

        // dd($ArrayLength);
        if( $ArrayLength == 0){
          $page = 1;
          $images = array();
          $images0 = array();
          // dd($userinfos);
        }


         if($ArrayLength <= MAX){
            if(!isset($request['page_id'])){
              $page=1;
              for($i=0;$i<$ArrayLength;$i++){
                $images[$i]['id'] = $images0[$i]->id;
                $images[$i]['user_id'] = $images0[$i]->user_id;
                $images[$i]['comment'] = $images0[$i]->comment;
                $images[$i]['image_path'] = $images0[$i]->image_path;
              }
            }
          }elseif($ArrayLength > MAX){
              if(!isset($request['page_id'])){
                  $page=1;
                  for($i=0;$i<MAX;$i++){
                    $images[$i]['id'] = $images0[$i]->id;
                    $images[$i]['user_id'] = $images0[$i]->user_id;
                    $images[$i]['comment'] = $images0[$i]->comment;
                    $images[$i]['image_path'] = $images0[$i]->image_path;
                  }
                }else{
                  $page = $request['page_id'];
                  $start_num = ($page-1)*MAX;
                  $end_num = $start_num + MAX;
                  $last_num = $ArrayLength-$start_num;
                  if($last_num >= MAX){
                    for($i=$start_num;$i<$end_num;$i++){
                      $images[$i]['id'] = $images0[$i]->id;
                      $images[$i]['user_id'] = $images0[$i]->user_id;
                      $images[$i]['comment'] = $images0[$i]->comment;
                      $images[$i]['image_path'] = $images0[$i]->image_path;
                    }
                  }else{
                    for($i=$start_num;$i<$ArrayLength;$i++){
                      $images[$i]['id'] = $images0[$i]->id;
                      $images[$i]['user_id'] = $images0[$i]->user_id;
                      $images[$i]['comment'] = $images0[$i]->comment;
                      $images[$i]['image_path'] = $images0[$i]->image_path;
                    }
                  }
                }
            }

        return view('admin.profile.info',compact('user','images','page','page_num'));
      }



      public function otherinfo(Request $request){
        $id = Auth::user()->id;
        $user = User::find($id);


        if(isset($request['userinfo_id'])){
        // dd($request['userinfo_id']);
        $userinfo = User::find($request['userinfo_id']);
        $images0 = Image::where('user_id', 'like', $request['userinfo_id'])->orderBy("images.id", "DESC")->get();
        $images0->sortByDesc('id');
      }else{
        $userinfo = User::find($request->id);
        $images0 = Image::where('user_id', 'like', $request->id)->orderBy("images.id", "DESC")->get();
        $images0->sortByDesc('id');

      }



        $favorite = Favorite::where('favorite_user_id',$id)->where('favorited_user_id',$userinfo['id'])->get();

         // dd(isset($favorite[0]));

        if(isset($favorite[0]) == true ){
        $favorite = $favorite[0];
      }else{
        $favorite = new Favorite;
        $favorite->favorite_user_id = $id;
        $favorite->favorited_user_id = $userinfo['id'];
        $favorite->status = "0";
        $favorite->save();
      }

        // dd($favorite);
        define('MAX','24');
        $ArrayLength = count($images0);
        $page_num = ceil($ArrayLength/MAX);

        // dd($ArrayLength);
        if( $ArrayLength == 0){
          $page = 1;
          $images = array();
          $images0 = array();
          // dd($userinfos);
        }


         if($ArrayLength <= MAX){
            if(!isset($request['page_id'])){
              $page=1;
              for($i=0;$i<$ArrayLength;$i++){
                $images[$i]['id'] = $images0[$i]->id;
                $images[$i]['user_id'] = $images0[$i]->user_id;
                $images[$i]['comment'] = $images0[$i]->comment;
                $images[$i]['image_path'] = $images0[$i]->image_path;
              }
            }
          }elseif($ArrayLength > MAX){
              if(!isset($request['page_id'])){
                  $page=1;
                  for($i=0;$i<MAX;$i++){
                    $images[$i]['id'] = $images0[$i]->id;
                    $images[$i]['user_id'] = $images0[$i]->user_id;
                    $images[$i]['comment'] = $images0[$i]->comment;
                    $images[$i]['image_path'] = $images0[$i]->image_path;
                  }
                }else{
                  $page = $request['page_id'];
                  $start_num = ($page-1)*MAX;
                  $end_num = $start_num + MAX;
                  $last_num = $ArrayLength-$start_num;
                  if($last_num >= MAX){
                    for($i=$start_num;$i<$end_num;$i++){
                      $images[$i]['id'] = $images0[$i]->id;
                      $images[$i]['user_id'] = $images0[$i]->user_id;
                      $images[$i]['comment'] = $images0[$i]->comment;
                      $images[$i]['image_path'] = $images0[$i]->image_path;
                    }
                  }else{
                    for($i=$start_num;$i<$ArrayLength;$i++){
                      $images[$i]['id'] = $images0[$i]->id;
                      $images[$i]['user_id'] = $images0[$i]->user_id;
                      $images[$i]['comment'] = $images0[$i]->comment;
                      $images[$i]['image_path'] = $images0[$i]->image_path;
                    }
                  }
                }
            }


        return view('admin.profile.otherinfo',compact('user','userinfo','images','favorite','page','page_num'));
      }



      public function gallary_edit(Request $request){
        $id = Auth::user()->id;
        $user = User::find($id);
        // $images = Image::where('user_id', 'like', $id)->get();
        $images = array();
        $images0 = Image::where('user_id', 'like', $id)->orderBy("images.id", "DESC")->get();
        // $images0=$images0->sortBy('id');


        // dd($favorite);
        define('MAX','16');
        $ArrayLength = count($images0);
        $page_num = ceil($ArrayLength/MAX);



        // dd($ArrayLength);
        if( $ArrayLength == 0){
          $page = 1;
          $images = array();
          $images0 = array();
          // dd($userinfos);
        }

         if($ArrayLength <= MAX){
            if(!isset($request['page_id'])){
              $page=1;
              for($i=0;$i<$ArrayLength;$i++){
                $images[$i]['id'] = $images0[$i]->id;
                $images[$i]['user_id'] = $images0[$i]->user_id;
                $images[$i]['comment'] = $images0[$i]->comment;
                $images[$i]['image_path'] = $images0[$i]->image_path;
              }
            }
          }elseif($ArrayLength > MAX){
              if(!isset($request['page_id']) ){
                  $page=1;
                  for($i=0;$i<MAX;$i++){
                    $images[$i]['id'] = $images0[$i]->id;
                    $images[$i]['user_id'] = $images0[$i]->user_id;
                    $images[$i]['comment'] = $images0[$i]->comment;
                    $images[$i]['image_path'] = $images0[$i]->image_path;
                  }
                }else{
                  $page = $request['page_id'];
                  $start_num = ($page-1)*MAX;
                  $end_num = $start_num + MAX;
                  $last_num = $ArrayLength-$start_num;
                  if($last_num >= MAX){
                    for($i=$start_num;$i<$end_num;$i++){
                      $images[$i]['id'] = $images0[$i]->id;
                      $images[$i]['user_id'] = $images0[$i]->user_id;
                      $images[$i]['comment'] = $images0[$i]->comment;
                      $images[$i]['image_path'] = $images0[$i]->image_path;
                    }
                  }else{
                    for($i=$start_num;$i<$ArrayLength;$i++){
                      $images[$i]['id'] = $images0[$i]->id;
                      $images[$i]['user_id'] = $images0[$i]->user_id;
                      $images[$i]['comment'] = $images0[$i]->comment;
                      $images[$i]['image_path'] = $images0[$i]->image_path;
                    }
                  }
                }
            }
            // dd($images0);

            if($images == [] && $images0 !== []){
              $ArrayLength2 = count($images0);
              $page_num = ceil($ArrayLength/MAX);
              // dd($page_num);
              $page = $page_num;

              $start_num = ($page-1)*MAX;
              $end_num = $start_num + MAX;
              $last_num = $ArrayLength-$start_num;

              if($last_num >= MAX){
                for($i=$start_num;$i<$end_num;$i++){
                  $images[$i]['id'] = $images0[$i]->id;
                  $images[$i]['user_id'] = $images0[$i]->user_id;
                  $images[$i]['comment'] = $images0[$i]->comment;
                  $images[$i]['image_path'] = $images0[$i]->image_path;
                }
              }else{
                for($i=$start_num;$i<$ArrayLength;$i++){
                  $images[$i]['id'] = $images0[$i]->id;
                  $images[$i]['user_id'] = $images0[$i]->user_id;
                  $images[$i]['comment'] = $images0[$i]->comment;
                  $images[$i]['image_path'] = $images0[$i]->image_path;
                }
              }

            }


        return view('admin.gallary.edit',compact('user','images','page','page_num'));
      }

        public function profileUpdate(Request $request){
          $id = Auth::user()->id;
          $user = User::find($id);

          $user->name = $request->name;
          $user->introduction = $request->profileText;
          // Log::debug($request);

          if($request->file !== 'undefined'){
            // Log::debug($user['profile_image_path']);
            // $path = $request->file('file')->store('public/image');
            // $path2 = str_replace('public/', '', $path);
            $image = $request['file'];
            $path = Storage::disk('s3')->putFile('/',$image,'public');
            // $path2 = str_replace('public/', '', $path);
            $user->profile_image_path = Storage::disk('s3')->url($path);


            }
          $user->save();

          return true;
        }


        public function gallaryUpdate(Request $request){
          $id = Auth::user()->id;

          // Log::debug(array($request['file']));

          // $fileNum = $request->id;
          if(isset($request['file'])){

            $images = new Image;
            $images->user_id = $id;
            $images->comment = "0";
            // dd($id);

            // $path = $request->file('file')->store('public/image');
            $image = $request['file'];
            $path = Storage::disk('s3')->putFile('/',$image,'public');
            // $path2 = str_replace('public/', '', $path);
            // dd($path);
            // $images->image_path = $path2;
            $images->image_path = Storage::disk('s3')->url($path);
            $images->save();
            }

          return true;
        }

        public function gallary_delete(Request $request){
          $id = $request->id;
          $imageId = $request->imageId;
          // dd($imageId);

          $image = Image::where('id', 'like', $imageId)->where('user_id', 'like', $id)->first();
          Log::debug($image['image_path']);
          $image_path = $image['image_path'];


          $disk = Storage::disk('s3');
          $disk->delete($image_path);
          $image->delete();


          return true;
        }

      public function favoritelist(Request $request){
        $id = Auth::user()->id;
        $user = User::find($id);


        $favorites = Favorite::where('favorite_user_id',$id)->where('status','1')->get();
        // dd($favorite);
        define('MAX','8');
        $ArrayLength = count($favorites);
        $page_num = ceil($ArrayLength/MAX);

        // dd($ArrayLength);
        if( $ArrayLength == 0){
          $page = 1;
          $userinfos = array();
          // dd($userinfos);
        }else{
          for($i=0;$i<$ArrayLength;$i++){
              $favoritedUserId = $favorites[$i]->favorited_user_id;
              $userinfos0[$i] = User::where('id',$favoritedUserId)->first();
              $userinfos0[$i]['status'] = $favorites[$i]->status;
            }
         }


         if($ArrayLength <= MAX){
            if(!isset($request['page_id'])){
              $page=1;
              for($i=0;$i<$ArrayLength;$i++){
                // $favoritedUserId = $favorites[$i]->favorited_user_id;
                $userinfos[$i] = $userinfos0[$i];
                $userinfos[$i]['status'] = $userinfos0[$i]['status'];
              }
            }
          }elseif($ArrayLength > MAX){
              if(!isset($request['page_id'])){
                  $page=1;
                  for($i=0;$i<MAX;$i++){
                  // $favoritedUserId = $favorites[$i]->favorited_user_id;
                  $userinfos[$i] = $userinfos0[$i];
                  $userinfos[$i]['status'] = $userinfos0[$i]['status'];
                  }
                }else{
                  $page = $request['page_id'];
                  $start_num = ($page-1)*MAX;
                  $end_num = $start_num + MAX;
                  $last_num = $ArrayLength-$start_num;
                  if($last_num >= MAX){
                    for($i=$start_num;$i<$end_num;$i++){
                      // $favoritedUserId = $favorites[$i]->favorited_user_id;
                      $userinfos[$i] = $userinfos0[$i];
                      $userinfos[$i]['status'] = $userinfos0[$i]['status'];
                    }
                  }else{
                    for($i=$start_num;$i<$ArrayLength;$i++){
                      // $favoritedUserId = $favorites[$i]->favorited_user_id;
                      $userinfos[$i] = $userinfos0[$i];
                      $userinfos[$i]['status'] = $userinfos0[$i]['status'];
                    }
                  }
                }
            }

        // $userinfosLength = count($userinfos);
        // dd($userinfos[0]['status']);

        return view('admin.reserch.favoritelist',compact('user','userinfos','page','page_num'));
      }



       public function reserchindex(Request $request){
          $id = Auth::user()->id;
          $user = User::find($id);
          $allUsers = new User;

          // dd($request->tag);
          if($request->page_id == null){
              if ( $request->reserch == null && $request->tag == null ){
                $profiles = new User;
                $profiles = $profiles->all();
                $reserch = $request->reserch;
                $tag = $request->tag;
                // dd($profiles);
              }elseif( $request->reserch !== null || $request->tag !== null){
                // $introductions = User::where('introduction', 'like', '%'.$cond_title.'%')->get();
                // $names = User::where('name', 'like', '%'.$cond_title.'%')->get();
                if(!is_null($request->tag)){
                  $tagreserch = $request->tag;
                  $tag = implode(" ",$tagreserch);

                }else{
                  $tag = 0;
                }
                if(!is_null($request->reserch)){
                  $reserch = $request->reserch;
                }else{
                  $reserch = 0;
                }

                $profiles = $allUsers->where('introduction', 'like', '%' . $reserch . '%')->orWhere('name', 'like', '%' . $reserch . '%')->orWhere('tag', 'like', "%$tag%")->get();
                // dd($profiles);
                // dd($tag);
              }
            }elseif($request->page_id !== null){
                // dd($request->reserch);
              if ( $request->reserch == null && $request->tag == null ){
                $profiles = new User;
                $profiles = $profiles->all();
                $reserch = $request->reserch;
                $tag = $request->tag;
              }elseif( $request->reserch !== null || $request->tag !== null){

                if(!is_null($request->tag)){
                  $tagreserch = $request->tag;
                  if(!is_array($tagreserch)){
                    $tag = $tagreserch;
                  }else{
                    $tag = implode(" ",$tagreserch);
                  }

                }else{
                  $tag = 0;
                }

                if(!is_null($request->reserch)){
                  $reserch = $request->reserch;
                }else{
                  $reserch = 0;
                }

                $profiles = User::where('introduction', 'like', '%' . $reserch . '%')->orWhere('name', 'like', '%' . $reserch . '%')->orWhere('tag', 'like', '%' . $tag . '%')->get();
                // dd($profiles);
                // dd($tag);
              }
            }
            // dd($profiles);
            define('MAX','8');
            $array_num = count($profiles);
            $page_num = ceil($array_num/MAX);

            if($array_num <= MAX){
                $page = 1;
                for($i=0;$i<$array_num;$i++){
                // dd($div_profiles[$i]['id']);
                // $div_profiles[$i] = $profiles[$i];
                $div_profiles[$i]['id'] = $profiles[$i]->id;
                $div_profiles[$i]['profile_image_path'] = $profiles[$i]->profile_image_path;
                $div_profiles[$i]['name'] = $profiles[$i]->name;
                $div_profiles[$i]['tag'] = $profiles[$i]->tag;
                $div_profiles[$i]['introduction'] = $profiles[$i]->introduction;
                }
                // dd('スルー');
              }else{
                  if(!isset($request['page_id'])){
                    $page = 1;
                    for($i=0;$i<MAX;$i++){
                      // dd($div_profiles[$i]['id']);
                      // $div_profiles[$i] = $profiles[$i];
                      $div_profiles[$i]['id'] = $profiles[$i]->id;
                      $div_profiles[$i]['profile_image_path'] = $profiles[$i]->profile_image_path;
                      $div_profiles[$i]['name'] = $profiles[$i]->name;
                      $div_profiles[$i]['tag'] = $profiles[$i]->tag;
                      $div_profiles[$i]['introduction'] = $profiles[$i]->introduction;
                    }
                  }else{
                    $page = $request['page_id'];
                    $start_num = ($page-1)*MAX;
                    $end_num = $start_num + MAX;
                    $last_num = $array_num-$start_num;

                    // dd($start_num);
                    if($last_num < MAX){
                      for($i=$start_num;$i<$array_num;$i++){
                        // $div_profiles[$i] = $profiles[$i]
                        $div_profiles[$i]['id'] = $profiles[$i]->id;
                        $div_profiles[$i]['profile_image_path'] = $profiles[$i]->profile_image_path;
                        $div_profiles[$i]['name'] = $profiles[$i]->name;
                        $div_profiles[$i]['tag'] = $profiles[$i]->tag;
                        $div_profiles[$i]['introduction'] = $profiles[$i]->introduction;
                      }
                    }else{
                      for($i=$start_num;$i<$end_num;$i++){
                        // $div_profiles[$i] = $profiles[$i]
                        $div_profiles[$i]['id'] = $profiles[$i]->id;
                        $div_profiles[$i]['profile_image_path'] = $profiles[$i]->profile_image_path;
                        $div_profiles[$i]['name'] = $profiles[$i]->name;
                        $div_profiles[$i]['tag'] = $profiles[$i]->tag;
                        $div_profiles[$i]['introduction'] = $profiles[$i]->introduction;
                      }
                    }
                  }
                }


          return view('admin.reserch.index',compact('user','div_profiles','reserch','tag','profiles','page_num','page'));

       }




       public function offer(Request $request){
          $id = Auth::user()->id;
          $user = User::find($id);
          $userinfoId = $request->id;
          // dd($user->id);


          return view('admin.message.offer',compact('user','userinfoId'));
       }

       public function sendoffer(Request $request){
         $sendUserId = Auth::user()->id;
         // dd($request['userinfo']);
         $receivedUserId = $request->userinfo;
         // dd($request->offer_text);

         $message = new Message;
         $message->sendUser_id = $sendUserId;
         $message->receivedUser_id = $receivedUserId;
         $message->message_content = $request->offer_text;
         $message->status = 1;

         if(isset($request['offer-image'])){

           // $path = $request->file('offer-image')->store('public/image');
           // $path2 = str_replace('public/', '', $path);
           // // dd($path2);
           // $message->image_path = $path2;

           $image = $request['offer-image'];
           $path = Storage::disk('s3')->putFile('/',$image,'public');
           // $path2 = str_replace('public/', '', $path);
           $message->image_path = Storage::disk('s3')->url($path);
         }else{
           $message->image_path = "";
         }

           $message->save();


           return redirect('admin/profile/info');
       }

       public function offerlist(){
         $id = Auth::user()->id;
         $user = User::find($id);
         // $userinfos = new User;
         // $userinfo = $request->id;


         $sendUserId = $id;
         $offer = new Offer;
         // $message = new Message;

         $offerMessages = Message::where('sendUser_id',$sendUserId)->where('status',1)->get();
         // 自分がオファーしたメッセージ
         $receivedOfferMessages = Message::where('receivedUser_id',$sendUserId)->where('status',1)->get();
         // 自分がオファーされたメッセージ


         $offercount = count($offerMessages);
         // dd($offercount);

         if($offercount!==0){
           for($i =0;$i<$offercount;$i++){
             $sendOfferUserId = $offerMessages[$i]->receivedUser_id;
             $userinfos1[$i] = User::where('id',$sendOfferUserId)->first();
             $userinfos1[$i]['message'] = $offerMessages[$i]->message_content;
             $userinfos1[$i]['check'] = "0";
           }
         }else{
             $userinfos1 = array();
         }
         // 自分がオファーしたユーザーの情報

         $receivedOffercount = count($receivedOfferMessages);

         if($receivedOffercount!==0){
           for($i =0;$i<$receivedOffercount;$i++){
             $sendOfferUserId = $receivedOfferMessages[$i]->sendUser_id;
             $userinfos2[$i] = User::where('id',$sendOfferUserId)->first();
             $userinfos2[$i]['message'] = $receivedOfferMessages[$i]->message_content;
             $userinfos2[$i]['check'] = "1";
           }
         }else{
           $userinfos2 = array();
         }
         // 自分にオファーを送ったユーザーの情報
         // Log::debug($userinfos);
         $all  = array_merge($userinfos1,$userinfos2);
         $collection = collect($all);
         $userinfos = $collection->sortBy('created_at');

         // dd($userinfos);





         return view('admin.message.offerlist',compact('user','userinfos'));
       }

       public function offermessage(Request $request){
         $id = Auth::user()->id;
         $user = User::find($id);
         $userinfo = $request->all();
         // dd($request);
         // dd($id);
         // dd($request->check);
         if($request->check == 0){
           $message = Message::where('sendUser_id',$id)->where('receivedUser_id',$request->id)->where('status',1)->first();
         // dd($message);
         // dd($request['check']);
         // $userinfo->message = $request->message;
        }elseif($request->check == 1){
           $message = Message::where('sendUser_id',$request->id)->where('receivedUser_id',$id)->where('status',1)->first();
         }

         // dd("?");
         return view('admin.message.offermessage',compact('user','message'));
       }


       public function choiceoffer(Request $request){
         $id = Auth::user()->id;
         $user = User::find($id);
         $userinfoId = $request->userinfoId;
         // dd($_POST['approval']);

         if(isset($_POST['approval'])){
           $message = Message::where('sendUser_id',$userinfoId)->where('receivedUser_id',$id)->where('status',1)->first();
           $message->status = 3;
           $message->save();
           // dd($message->status);
       }elseif(isset($_POST['pass'])){
           $message = Message::where('sendUser_id',$userinfoId)->where('receivedUser_id',$id)->where('status',1)->first();
           $message->status = 0;
           $message->save();
           // dd($message->status);

         }
         return redirect('admin/profile/info');
       }

       public function message(){
         $id = Auth::user()->id;
         $user = User::find($id);

         $message1 = Message::where('receivedUser_id',$id)->where('status',3)->get();
         $num = count($message1);
         for($i=0;$i<$num;$i++) {
           $message1[$i] = Message::where('receivedUser_id',$id)->where('status',3)->first();
           $mes1 = $message1[$i]->sendUser_id;
           $userinfo1[$i] = User::where('id',$mes1)->first();
           $userinfo1[$i]['message'] = $message1[$i]->message_content;
         }
         if(!isset($userinfo1)){
           $userinfo1 = array();
         }

         // dd($userinfoId1);

         $message2 = Message::where('sendUser_id',$id)->where('status',3)->get();
         $num = count($message2);
         for($i=0;$i<$num;$i++) {
           $message2[$i] = Message::where('sendUser_id',$id)->where('status',3)->first();
           $mes2 = $message2[$i]->receivedUser_id;
           $userinfo2[$i] = User::where('id',$mes2)->first();
           $userinfo2[$i]['message'] = $message2[$i]->message_content;
         }
         if(!isset($userinfo2)){
           $userinfo2 = array();
         }

        $userinfos = array_merge($userinfo1,$userinfo2);
        // dd($userinfos);

         return view('admin.message.messagelist',compact('user','userinfos'));
       }


       public function talk(Request $request){
         $id = Auth::user()->id;
         $user = User::find($id);
         $userinfoId = $request->id;
         $username = $request->name;
         Log::debug("p");
         Log::debug($userinfoId);
          // if(!isset($request->id)){
          //   $serch1 = Message::where('sendUser_id',$id)->where('status',3)->orderBy()->first();
          //   $userinfoId = $serch1['receivedUser_id'];
          //   Log::debug($userinfoId);
          // }

         // dd($request->id);

         // 受け取ったメッセージ
         $message13 = Message::where('sendUser_id',$userinfoId)->where('receivedUser_id',$id)->where('status',3)->get();
         $num13 = count($message13);
         $message13 = array();
         // dd($num13);

         for($i=0;$i<$num13;$i++) {
           $message13[$i] = Message::where('sendUser_id',$userinfoId)->where('receivedUser_id',$id)->where('status',3)->first();
           $mes13 = $message13[$i]->sendUser_id;
           $userinfo13[$i] = User::where('id',$mes13)->first();
           $message13[$i]['profile_image_path'] = $userinfo13[$i]->profile_image_path;
           $message13[$i]['send_user'] = "you";
           // $userinfo13[$i]['message'] = $message13[$i]->message_content;
         }
         if(!isset($message13)){
           $message13 = array();
         }

         // dd($message13);

         $messages12 = Message::where('sendUser_id',$userinfoId)->where('receivedUser_id',$id)->where('status',2)->get();


         if(isset($messages12)){
           $array12 = array();
           foreach ($messages12 as $message12 ) {
             $mes12 = $message12->sendUser_id;
             $userinfo12 = User::where('id',$mes12)->first();
             $message12['profile_image_path'] = $userinfo12->profile_image_path;
             $array12[] = $message12;
           }
         }

           // Log::debug($array);



         if(!isset($messages12)){
           $array12 = array();
         }


         $receivemessage = array_merge($message13,$array12);
         $receiveNum = count($receivemessage);
         Log::debug($receivemessage);


         // 送ったメッセージ

         $message23 = Message::where('sendUser_id',$id)->where('receivedUser_id',$userinfoId)->where('status',3)->get();
         $num23 = count($message23);
         $message23 = array();
         for($i=0;$i<$num23;$i++) {
           $message23[$i] = Message::where('sendUser_id',$id)->where('receivedUser_id',$userinfoId)->where('status',3)->first();
           $mes23 = $message23[$i]->sendUser_id;
           $userinfo23[$i] = User::where('id',$mes23)->first();
           $message23[$i]['profile_image_path'] = $user->profile_image_path;
           $message23[$i]['send_user'] = "me";
         }
         if(!isset($message23)){
           $message23 = array();
         }

         // dd($message13);

         $messages22 = Message::where('sendUser_id',$id)->where('receivedUser_id',$userinfoId)->where('status',2)->get();
         // $num22 = count($message22);
         // $message22 = array();
         // for($i=0;$i<$num22;$i++) {
         //   $message22[$i] = Message::where('sendUser_id',$id)->where('receivedUser_id',$userinfoId)->where('status',2)->first();
         //   $mes22 = $message22[$i]->sendUser_id;
         //   $userinfo22[$i] = User::where('id',$mes22)->first();
         //   $message22[$i]['profile_image_path'] = $user->profile_image_path;
         //   $message22[$i]['send_user'] = "me";
         //   Log::debug($message22[$i]['message_content']);
         // }



         if(isset($messages22)){
           $array22 = array();
           foreach ($messages22 as $message22 ) {
             $mes22 = $message22->sendUser_id;
             $userinfo22 = User::where('id',$mes22)->first();
             $message22['profile_image_path'] = $userinfo22->profile_image_path;
             $array22[] = $message22;
           }
         }

           // Log::debug($array);



         if(!isset($messages22)){
           $array22 = array();
         }

         $sendmessage = array_merge($message23,$array22);
         $sendNum = count($sendmessage);
         Log::debug($sendNum);

         $all = array_merge($receivemessage,$sendmessage);
         $collection = collect($all);
         $allmessage = $collection->sortBy('created_at');



         // Log::debug("配列確認");
         // Log::debug($collection);
         // Log::debug("配列確認");
         // Log::debug("配列確認");
         // Log::debug($allmessage);
         // Log::debug("配列確認");



         return view('admin.message.talk',compact('user','allmessage','userinfoId','username'));
       }

       public function updateMessage(Request $request){
         $id = Auth::user()->id;
         $user = User::find($id);
         // $userinfoId = $request->id;
         Log::debug($request->file);

         $messagebefore1 = Message::where('sendUser_id',$id)->where('receivedUser_id',$request['receiveUserId'])->where('status',3)->first();

         $messagebefore2 = Message::where('sendUser_id',$request['receiveUserId'])->where('receivedUser_id',$id)->where('status',3)->first();

         Log::debug($messagebefore1);

         if(isset($messagebefore1)){
           $messagebefore1['status'] = "2";
           Log::debug("1");
           Log::debug($messagebefore1);
           $messagebefore1->save();
         }

         if(isset($messagebefore2)){
           $messagebefore2['status'] = "2";
           Log::debug("2");
           $messagebefore2->save();
         }


         $message = new Message;
         $message->sendUser_id = $id;
         $message->receivedUser_id = $request['receiveUserId'];
         $message->message_content = $request['sendText'];
         $message->status = 3;
         // $message['send_user'] = 'me';

         if($request->file !== 'undefined' ){
           Log::debug("成功");
           $image = $request['file'];
           $path = Storage::disk('s3')->putFile('/',$image,'public');
           // $path2 = str_replace('public/', '', $path);
           $message->image_path = Storage::disk('s3')->url($path);
         }else{
           $message->image_path = "";
         }

         Log::debug($message->image_path);

         $message->save();

         // return view('admin.message.talk',compact('user','allmessage'));
         return true;
       }


}
