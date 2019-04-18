<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer_type');
            $table->string('company_name')->nullable();
            $table->string('primary_contact')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('email');
            $table->string('website')->nullable();
            $table->string('telephone')->nullable();
            $table->string('id_number')->nullable();
            $table->string('fax')->nullable();
            $table->string('address')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('vat_no')->nullable();
            $table->string('user_id')->nullable();
            $table->string('account_id')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
