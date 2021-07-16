<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_zones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipping_method_id')->constrained()->onDelete('cascade');
            $table->string('region');
            $table->string('delay');
            $table->string('price');
            $table->integer('actual_price');
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
        Schema::table('shipping_zones', function(BluePrint $table){
            $table->dropForeign(['shipping_method_id']);
            $table->dropColumn('shipping_method_id');
        });

        Schema::dropIfExists('shipping_zones');
    }
}
