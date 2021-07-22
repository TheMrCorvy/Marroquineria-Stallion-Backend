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
            $table->foreignId('sale_order_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('unit_price');
            $table->integer('amount');
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
        Schema::table('sales', function (BluePrint $table) {
            $table->dropForeign(['sale_order_id']);
            $table->dropColumn('sale_order_id');

            $table->dropForeign(['product_id']);
            $table->dropColumn('product_id');
        });

        Schema::dropIfExists('sales');
    }
}
