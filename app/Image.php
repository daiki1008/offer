<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
  protected $guarded = array('id');

  public static $rules = array(
      'user_id' => 'required',
      'image_path' => 'required',
      'comment' => 'required',

  );
}
