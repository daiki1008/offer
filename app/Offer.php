<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
  protected $guarded = array('id');

  public static $rules = array(
      'offer_send_id' => 'required',
      'offer_received_id' => 'required',
      'status' => 'required',
  );
}
