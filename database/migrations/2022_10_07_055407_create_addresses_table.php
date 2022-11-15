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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('addresstype_id')->unsigned()->nullable();
            $table->foreign('addresstype_id', 'addresstypes_address_id_fk')->references('id')->on('addresstypes')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->string('line1');
            $table->string('line2');
            $table->string('line3')->nullable();
            $table->string('line4')->nullable();
            $table->string('postalcode');
            $table->decimal('lat',11,8)->unsigned()->nullable();
            $table->decimal('long',11,8)->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /*
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
};
