<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
  protected $guarded = array('id');

  public static $rules = array(
      'favorite_user_id' => 'required',
      'favorited_user_id' => 'required',
      'status' => 'required',

  );
}
