<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShareholderCompositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shareholder_compositions', function (Blueprint $table) {
            $table->id();
            $table->date('date')->index();
            $table->string('code')->index();
            $table->string('type')->index();
            $table->unsignedBigInteger('number_of_securities');
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('domestic_total');
            $table->unsignedBigInteger('foreign_total');
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
        Schema::dropIfExists('shareholder_compositions');
    }
}
