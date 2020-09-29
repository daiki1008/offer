<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
  protected $guarded = array('id');

  public static $rules = array(
      'sendUser_id' => 'required',
      'receivedUser_id' => 'required',
      'message_content' => 'required',
      'image_path' => 'required',
      'status' => 'required',
);
}
