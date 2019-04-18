<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRateChargeAccountToServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('services', function (Blueprint $table){
            $table->float('rate_charge')->nullable();
            $table->float('mileage_charge')->nullable();
            $table->float('flight_cost')->nullable();
            $table->integer('account_id');
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
        Schema::table('services', function (Blueprint $table){
            $table->dropColumn('rate_charge');
            $table->dropColumn('mileage_charge');
            $table->dropColumn('flight_cost');
            $table->dropColumn('account_id');
        });
    }
}
