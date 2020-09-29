<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Favorite;

class FavoriteController extends Controller
{

    public function execute(Request $request){
      $id = $request->id;
      $loginId = $request->loginId;
      $favorite = new Favorite;

      $check = Favorite::where('favorite_user_id',$loginId)->where('favorited_user_id',$id)->get();
      // dd($check[0]->id);
      if( isset($check[0]->id) == true){
        // dd("変更前",$check[0]->status,$check[0]->id);

           if($check[0]->status == "1"){
              $check[0]->status = "0";
              $check[0]->save();
           }else if($check[0]->status == "0"){
              $check[0]->status = "1";
              $check[0]->save();
           }
            // dd("変更後",$check[0]->status,$check[0]->id);

      }else if(isset($check[0]->id) !== true){


      $favorite->favorite_user_id = $loginId;
      $favorite->favorited_user_id = $id;
      $favorite->status = "1";
      // dd($favorite);

      $favorite->save();
    }

      // $check2 = Favorite::where('favorite_user_id',$loginId)->where('favorited_user_id',$id)->get();

       return true;


    }
}
