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
        Schema::create('product_item_elements', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_item_id')->unsigned()->nullable();
            $table->foreign('product_item_id', 'product_item_elements_product_item_id_fk')->references('id')->on('product_items')->onUpdate('RESTRICT')->onDelete('RESTRICT');            
            $table->string('size')->index();
            $table->string('price');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_item_elements');
    }
};
