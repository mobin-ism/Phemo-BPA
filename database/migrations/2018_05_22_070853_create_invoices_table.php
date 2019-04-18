<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice_no');
            $table->string('po')->nullable();
            $table->integer('customer_id');
            $table->integer('invoice_date');
            $table->integer('due_date')->nullable();
            $table->text('products')->nullable();
            $table->text('services')->nullable();
            $table->integer('status')->default(1);
            $table->integer('payment_status')->default(1);
            $table->float('sub_total')->nullable();
            $table->float('discount')->nullable();
            $table->float('total_tax')->nullable();
            $table->float('freight_charge')->nullable();
            $table->float('grand_total')->nullable();
            $table->text('note')->nullable();
            $table->integer('user_id');
            $table->integer('account_id');
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
        Schema::dropIfExists('invoices');
    }
}
