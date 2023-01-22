<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_items', function (Blueprint $table) {
            $table->id();
            $table->integer('pos_id');
            $table->integer('product_id');
            $table->string('type');
            $table->string('code');
            $table->string('image')->nullable();
            $table->string('gem_type')->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('weight', 5, 2)->nullable();
            $table->integer('price')->nullable();
            $table->string('gold_quantity_p');
            $table->string('gold_quantity_y');
            $table->integer('gold_price');
            $table->string('ad_gold_quantity_p');
            $table->string('ad_gold_quantity_y');
            $table->string('ad_gold_price');
            $table->integer('service_charges');
            $table->integer('total_price');
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
        Schema::dropIfExists('pos_items');
    }
};
