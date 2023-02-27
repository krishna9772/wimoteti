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
        Schema::create('exchange_returns', function (Blueprint $table) {
            $table->id();
            $table->integer('pos_id');
            $table->enum('type',[ 'exchange' , 'full-return']);
            $table->string('percentage');
            $table->string('extra_charges');
            $table->integer('final_amount');
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
        Schema::dropIfExists('exchange_returns');
    }
};
