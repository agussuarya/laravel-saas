<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foreign_transactions', function (Blueprint $table) {
            $table->id();
            $table->date('transaction_date')->index();
            $table->string('stock_code')->index();
            $table->unsignedInteger('last_price');
            $table->integer('change_value');
            $table->float('change_percentage', 5, 2);
            $table->float('grid_fluctuation_ratio', 5, 2);
            $table->unsignedBigInteger('frequency');

            // Volume (shares)
            $table->unsignedBigInteger('volume');

            $table->unsignedBigInteger('value');
            $table->string('type')->index();

            // If type column is volume then the columns below in shares
            // If type column is value then the columns below in idr
            $table->unsignedBigInteger('foreign_buy');
            $table->unsignedBigInteger('foreign_sell');
            $table->bigInteger('net_buy');
            $table->bigInteger('net_sell');

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
        Schema::dropIfExists('foreign_transactions');
    }
}
