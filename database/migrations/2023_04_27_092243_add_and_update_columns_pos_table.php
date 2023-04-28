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
        Schema::table('pos_items', function (Blueprint $table) {
            
            $table->string('quantity')->change();
            $table->string('gem_quantity')->after('quantity')->nullable();
            $table->string('weight')->change();
            $table->string('price')->change();
            $table->string('weight_type')->after('weight')->nullable();
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
        Schema::table('pos_items', function($table) {
            $table->integer('quantity')->change();
            $table->decimal('weight', 5, 2)->change(); 
            $table->integer('price')->change();
            $table->dropColumn('weight_type');
            $table->decimal('ad_gold_quantity');
            $table->dropColumn('gem_quantity');
            $table->dropColumn('gold_quantity_k');
            $table->dropColumn('ad_gold_quantity_k');
        });
    }
};
