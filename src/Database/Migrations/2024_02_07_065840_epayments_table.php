<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EpaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('epayments', function (Blueprint $table) {
            $table->id();
            $table->string('order_id', 10)->nullable();
            $table->string('order_id_satim')->nullable();
            $table->boolean('status');
            $table->boolean('bool')->nullable();
            $table->string('error_code')->nullable();
            $table->string('code')->nullable();
            $table->string('total')->nullable();
            $table->string('message_return')->nullable();
            $table->dateTime('date_transaction')->nullable();
            $table->dateTime('date_expiration')->nullable();
            $table->string('file')->nullable();
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
        Schema::dropIfExists('epayments');
    }
}
