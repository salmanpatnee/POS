<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id');
            $table->foreignId('customer_id');
            $table->foreignId('user_id');
            $table->foreignId('product_id');
            $table->decimal('tax', 10, 2)->nullable();
            $table->decimal('net', 10, 2);
            $table->decimal('total', 10, 2);
            $table->integer('payment_method')->default(1);
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
        Schema::dropIfExists('sales');
    }
}
