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

class ProfileController extends Controller
{

     public function add(){
       return view('auth.register');
     }

     public function create(Request $request){

     }

     public function info(){
        $id = Auth::user()->id;
        $user = User::find($id);

        $images = Image::where('user_id', 'like', $id)->get();
        // dd($check);

        return view('admin.profile.info',compact('user','images'));
      }



      public function otherinfo(Request $request){
        $id = Auth::user()->id;
        $user = User::find($id);
        $userinfo = User::find($request->id);


        $favorite = Favorite::where('favorite_user_id',$id)->where('favorited_user_id',$userinfo->id)->get();

         // dd(isset($favorite[0]));

        if(isset($favorite[0]) == true ){
        $favorite = $favorite[0];
      }else{
        $favorite = new Favorite;
        $favorite->favorite_user_id = $id;
        $favorite->favorited_user_id = $userinfo->id;
        $favorite->status = "0";
        $favorite->save();
      }
          // dd(isset($favorite));
        // dd($favorite->status);

        $images = Image::where('user_id', 'like', $request->id)->get();
        // dd($user);

        return view('admin.profile.otherinfo',compact('user','userinfo','images','favorite'));
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

      public function gallary_update(Request $request){
          $id = Auth::user()->id;
          $user = User::find($id);

        if(isset($request['uplode_file'])){

          $images = new Image;
          $images->user_id = $id;
          $images->comment = $request['comment'];
          // dd($id);

          $path = $request->file('uplode_file')->store('public/image');
          $path2 = str_replace('public/', '', $path);
          $images->image_path = $path2;
          $images->save();
          }

        return redirect('admin/gallary/edit');
        }

        public function profileUpdate(Request $request){
          $id = Auth::user()->id;
          $user = User::find($id);

          // dd($request->file);
          $user->name = $request->name;
          $user->introduction = $request->profileText;

          if($request->file !== 'undefined'){

            $path = $request->file('file')->store('public/image');
            $path2 = str_replace('public/', '', $path);
            $user->profile_image_path = $path2;

            }
          $user->save();

          return true;
        }


        public function gallaryUpdate(Request $request){
          $id = Auth::user()->id;

          // dd($request['file']);
          // $fileNum = $request->id;
          if(isset($request['file'])){

            $images = new Image;
            $images->user_id = $id;
            $images->comment = "0";
            // dd($id);

            $path = $request->file('file')->store('public/image');
            $path2 = str_replace('public/', '', $path);
            // dd($path2);
            $images->image_path = $path2;
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

      public function favoritelist(){
        $id = Auth::user()->id;
        $user = User::find($id);


        $favorites = Favorite::where('favorite_user_id',$id)->where('status','1')->get();
        // dd($favorite);
        $ArrayLength = count($favorites);
        // dd($ArrayLength);
        if( $ArrayLength == 0){
          $userinfos = array();
          // dd($userinfos);
        }else{

        for($i=0;$i<$ArrayLength;$i++){
            $favoritedUserId = $favorites[$i]->favorited_user_id;
            $userinfos[$i] = User::where('id',$favoritedUserId)->first();
            $userinfos[$i]['status'] = $favorites[$i]->status;
        }
      }

        // $userinfosLength = count($userinfos);
        // dd($userinfos[0]['status']);

        return view('admin.reserch.favoritelist',compact('user','userinfos'));
      }

       public function reserch(){

          $id = Auth::user()->id;
          $user = User::find($id);
          $profiles = new User;
          $profiles = $profiles->all();

          return view('admin.reserch.index',compact('user','profiles'));
       }


       public function reserchindex(Request $request){
          $id = Auth::user()->id;
          $user = User::find($id);

          $reserch = $request->reserch;
          $tagreserch = $request->tag;
          // dd($tagreserch);


          if(!is_null($tagreserch)){
            $tag = implode(" ",$tagreserch);
          }else{
            $tag = 0;
          }

          if(is_null($reserch)){
            $reserch = 0;
          }
          // dd($tag);

          if ( $reserch !== 0 || $tag !== 0){
           // $introductions = User::where('introduction', 'like', '%'.$cond_title.'%')->get();
           // $names = User::where('name', 'like', '%'.$cond_title.'%')->get();
           $profiles = User::where('introduction', 'like', '%' . $reserch . '%')->orWhere('name', 'like', '%' . $reserch . '%')->orWhere('tag', 'like', '%' . $tag . '%')->get();
           // dd($profiles);
           // dd($tag);
          }else{
            $profiles = array();
            // dd('0');
          }

          return view('admin.reserch.index',compact('user','profiles'));
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
         // dd($userinfos);
         // foreach ($userinfos as $index => $value) {
         // $sort[$index] = $value['created_at'];
         // }
         // array_multisort($sort, SORT_ASC, $userinfos);
         // dd($userinfos);


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
