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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('contacttype_id')->unsigned()->nullable();
            $table->foreign('contacttype_id', 'contacttypes_contact_id_fk')->references('id')->on('contacttypes')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->string('number');
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
        Schema::dropIfExists('contacts');
    }
};
