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

     public function create(Request $request){

     }

     public function info(Request $request){
        $id = Auth::user()->id;
        $user = User::find($id);

        $images0 = Image::where('user_id', 'like', $id)->get();


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
        $images0 = Image::where('user_id', 'like', $request['userinfo_id'])->get();
      }else{
        $userinfo = User::find($request->id);
        $images0 = Image::where('user_id', 'like', $request->id)->get();

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
          // dd(isset($favorite));
        // dd($favorite->status);

        // $images = Image::where('user_id', 'like', $request->id)->get();
        // dd($user);




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



     public function edit(){
         return view('admin.profile.edit');
      }

      public function update(){
         return redirect('admin/profile/edit');
      }



      public function gallary_edit(){
        $id = Auth::user()->id;
        $user = User::find($id);
        $images = Image::where('user_id', 'like', $id)->get();

        return view('admin.gallary.edit',compact('user','images'));
      }

      // public function gallary_update(Request $request){
      //     $id = Auth::user()->id;
      //     $user = User::find($id);
      //
      //   if(isset($request['uplode_file'])){
      //
      //     $images = new Image;
      //     $images->user_id = $id;
      //     $images->comment = $request['comment'];
      //     // dd($id);
      //
      //     $path = Storage::disk('s3')->putFile('/',$form['uplode_file'],'public');
      //     dd($path);
      //     $path2 = str_replace('public/', '', $path);
      //     // $images->image_path = $path2;
      //     $images->image_path = Storage::disk('s3')->url($path);
      //     $images->save();
      //     }
      //
      //   return redirect('admin/gallary/edit');
      //   }

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

          $image = Image::where('id', 'like', $imageId)->where('user_id', 'like', $id)->delete();


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

       // public function reserch(Request $request){
       //
       //    $id = Auth::user()->id;
       //    $user = User::find($id);
       //    // dd($request);
       //
       //
       //    $profiles = new User;
       //    $profiles = $profiles->all();
       //    // $profilesArray = (array)$profiles;
       //
       //    // dd($profilesArray);
       //
       //    define('MAX','8');
       //    $array_num = count($profiles);
       //    $page_num = ceil($array_num/MAX);
       //
       //    if(!isset($request['page_id'])){
       //      $page = 1;
       //      for($i=0;$i<MAX;$i++){
       //      // dd($div_profiles[$i]['id']);
       //      // $div_profiles[$i] = $profiles[$i];
       //      $div_profiles[$i]['id'] = $profiles[$i]->id;
       //      $div_profiles[$i]['profile_image_path'] = $profiles[$i]->profile_image_path;
       //      $div_profiles[$i]['name'] = $profiles[$i]->name;
       //      $div_profiles[$i]['tag'] = $profiles[$i]->tag;
       //      $div_profiles[$i]['introduction'] = $profiles[$i]->introduction;
       //      }
       //    }else{
       //      $page = $request['page_id'];
       //      $start_num = ($page-1)*MAX;
       //      $end_num = $start_num + MAX;
       //      for($i=$start_num;$i<$end_num;$i++){
       //        // $div_profiles[$i] = $profiles[$i]
       //        $div_profiles[$i]['id'] = $profiles[$i]->id;
       //        $div_profiles[$i]['profile_image_path'] = $profiles[$i]->profile_image_path;
       //        $div_profiles[$i]['name'] = $profiles[$i]->name;
       //        $div_profiles[$i]['tag'] = $profiles[$i]->tag;
       //        $div_profiles[$i]['introduction'] = $profiles[$i]->introduction;
       //      }
       //      // $div_profiles = $profiles[$i];
       //    }
       //
       //    // dd($div_profiles['id']);
       //    // dd($div_profiles[1]['id']);
       //    return view('admin.reserch.index',compact('user','div_profiles','profiles','page_num','page'));
       // }


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
          $userinfo = $request->id;
          // dd($userinfoId);


          return view('admin.message.offer',compact('user','userinfo'));
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

           $path = $request->file('offer-image')->store('public/image');
           $path2 = str_replace('public/', '', $path);
           // dd($path2);
           $message->image_path = $path2;
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
             $masseges = $offerMessages[$i];
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
             $masseges = $receivedOfferMessages[$i];
             $userinfos2[$i] = User::where('id',$sendOfferUserId)->first();
             $userinfos2[$i]['message'] = $receivedOfferMessages[$i]->message_content;
             $userinfos2[$i]['check'] = "1";
           }
         }else{
           $userinfos2 = array();
         }
         // 自分にオファーを送ったユーザーの情報

         $userinfos = array_merge($userinfos1,$userinfos2);


         


         return view('admin.message.offerlist',compact('user','userinfos'));
       }

       public function offermessage(Request $request){
         $id = Auth::user()->id;
         $user = User::find($id);
         $userinfo = $request->all();
         // dd($userinfo['message']);
         // $userinfo->message = $request->message;
         return view('admin.message.offermessage',compact('user','userinfo'));
       }




}
