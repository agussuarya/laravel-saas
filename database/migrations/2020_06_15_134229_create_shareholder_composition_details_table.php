<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShareholderCompositionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shareholder_composition_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shareholder_composition_id');
            $table->string('investor_status')->index();
            $table->string('investor_type')->index();
            $table->unsignedBigInteger('number_of_shares');
            $table->timestamps();

            $table->foreign('shareholder_composition_id', 'sc_id_foreign')
                ->references('id')
                ->on('shareholder_compositions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shareholder_composition_details');
    }
}
