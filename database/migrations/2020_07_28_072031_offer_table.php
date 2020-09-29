<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OfferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('offer', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('offer_send_id');
        $table->string('offer_received_id');
        $table->string('status');
        $table->string('create_at');
        $table->string('edit_at');
        $table->timestamps();
    });
  }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offer');
    }
}
