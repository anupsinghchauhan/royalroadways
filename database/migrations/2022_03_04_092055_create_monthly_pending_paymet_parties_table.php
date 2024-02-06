<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlyPendingPaymetPartiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_pending_paymet_parties', function (Blueprint $table) {
            $table->id('pending_paymet_party_id');
            $table->unsignedBigInteger('billing_id')->nullable();
            $table->tinyInteger('lr_mode')->nullable();
            $table->string('party_name',200)->nullable();
            $table->string('truckno',50)->nullable();
            $table->integer('lrno')->nullable();
            $table->string('royal_from',100)->nullable();
            $table->string('consignor1',100)->nullable();
            $table->string('consignee1',100)->nullable();
            $table->string('royal_to',100)->nullable();
            $table->string('weight1',50)->nullable();
            $table->string('rate1',50)->nullable();
            $table->string('total_amount',10)->nullable();
            $table->string('total_paid_amount',20)->nullable();
            $table->dateTime('royal_date')->nullable();
            $table->foreign('billing_id')->references('id')->on('billings')->onDelete('cascade');
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
        Schema::dropIfExists('monthly_pending_paymet_parties');
    }
}
