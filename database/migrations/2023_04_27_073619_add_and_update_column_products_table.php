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
            
            $table->string('quantity')->change();
            $table->string('weight')->change();
            $table->string('price')->change();
            $table->string('weight_type')->nullable()->change();
            $table->string('gold_quantity_k')->after('price')->nullable();
            $table->string('ad_gold_quantity_k')->after('gold_price')->nullable();
    
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
            $table->integer('quantity')->nullable()->change();
            $table->decimal('weight', 5, 2)->nullable()->change(); 
            $table->integer('price')->nullable()->change();
            $table->integer('weight_type')->nullable()->change();
            $table->dropColumn('gold_quantity_k');
            $table->dropColumn('ad_gold_quantity_k');
        });
    }
};
