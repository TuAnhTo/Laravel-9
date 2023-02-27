<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transport_protocols', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('shipping_method_id');
            $table->string('live_status');
            $table->string('username');
            $table->string('pasword');
            $table->string('pickup_address_line1')->nullable();
            $table->string('pickup_suburb')->nullable();
            $table->string('pickup_postcode')->nullable();
            $table->string('pickup_country')->defalut('AU')->nullable();
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
        Schema::dropIfExists('transport_protocols');
    }
};
