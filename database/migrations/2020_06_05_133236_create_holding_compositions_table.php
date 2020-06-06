<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoldingCompositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('holding_compositions', function (Blueprint $table) {
            $table->id();
            $table->date('date')->index();
            $table->string('code')->index();
            $table->string('type')->index();
            $table->unsignedBigInteger('number_of_securities');
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('local_is');
            $table->unsignedBigInteger('local_cp');
            $table->unsignedBigInteger('local_pf');
            $table->unsignedBigInteger('local_ib');
            $table->unsignedBigInteger('local_id');
            $table->unsignedBigInteger('local_mf');
            $table->unsignedBigInteger('local_sc');
            $table->unsignedBigInteger('local_fd');
            $table->unsignedBigInteger('local_ot');
            $table->unsignedBigInteger('local_total');
            $table->unsignedBigInteger('foreign_is');
            $table->unsignedBigInteger('foreign_cp');
            $table->unsignedBigInteger('foreign_pf');
            $table->unsignedBigInteger('foreign_ib');
            $table->unsignedBigInteger('foreign_id');
            $table->unsignedBigInteger('foreign_mf');
            $table->unsignedBigInteger('foreign_sc');
            $table->unsignedBigInteger('foreign_fd');
            $table->unsignedBigInteger('foreign_ot');
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
        Schema::dropIfExists('holding_compositions');
    }
}
