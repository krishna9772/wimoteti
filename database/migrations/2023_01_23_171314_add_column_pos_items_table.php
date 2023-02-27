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
            
            $table->decimal('net_weight', 5, 2)->after('service_charges')->nullable();
    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pos_items', function (Blueprint $table) {
            
            $table->dropColumn('net_weight');

        });
    }
};
