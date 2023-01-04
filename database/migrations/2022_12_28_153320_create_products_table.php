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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('code');
            $table->string('image')->nullable();
            $table->string('gem_type')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('price')->nullable();
            $table->string('gold_quantity');
            $table->integer('gold_price');
            $table->string('ad_gold_quantity');
            $table->integer('ad_gold_price');
            $table->integer('total_price');
            $table->integer('service_charges');
            $table->boolean('status')->default(true);
            $table->integer('created_by');
            $table->integer('updated_by');
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
        Schema::dropIfExists('products');
    }
};
