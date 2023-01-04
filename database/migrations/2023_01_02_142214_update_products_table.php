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
        Schema::table('products', function (Blueprint $table) {
            
            $table->dropColumn('gold_quantity');
            $table->dropColumn('ad_gold_quantity');
            $table->string('gold_quantity_p')->after('price');
            $table->string('gold_quantity_y')->after('gold_quantity_p');
            $table->string('ad_gold_quantity_p')->after('gold_price');
            $table->string('ad_gold_quantity_y')->after('ad_gold_quantity_p');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function($table) {
            $table->string('gold_quantity');
            $table->string('ad_gold_quantity');
            $table->dropColumn('gold_quantity_p');
            $table->dropColumn('ad_gold_quantity_p');
            $table->dropColumn('ad_gold_quantity_y');
        });
       
    }
};
