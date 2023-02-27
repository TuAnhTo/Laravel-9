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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('store_id');
            $table->string('description');
            $table->string('media');
            $table->float('price', 8, 2);
            $table->float('compare_at_price', 8, 2)->nullable();
            $table->float('cost_per_item', 8, 2)->nullable();
            $table->boolean('change_tax');
            $table->string('sku')->nullable();
            $table->string('barcode')->nullable();
            $table->boolean('track_quantity')->defalut(false);
            $table->boolean('continue_selling')->defalut(false);
            $table->boolean('physical_product')->defalut(false);
            $table->boolean('weight');
            $table->string('product_type')->comment('1:single_product, 2:variant_product');
            $table->string('country_of_origin')->nullable();
            $table->string('hs_code')->nullable();
            $table->boolean('option')->defalut(false);
            $table->boolean('status')->defalut(false);
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('sub_category_id')->unsigned()->nullable();
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
        //
        Schema::dropIfExists('products');
    }
};
