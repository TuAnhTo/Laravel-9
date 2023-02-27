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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('store_country')->nullable();
            $table->string('personal_country')->nullable();
            $table->bigInteger('phone')->nullable();
            $table->string('business_type')->nullable();
            $table->integer('monthly_revenue')->nullable();
            $table->string('store_id')->nullable();
            $table->boolean('status')->nullable()->default(true);
            $table->softDeletes($column = 'deleted_at', $precision = 0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
