<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_information', function (Blueprint $table) {
            $table->id();
            $table->text('client_name');
            $table->integer('bill_no')->nullable();
            $table->string('send_email_id',150)->nullable();
            $table->dateTime('bill_date')->nullable();
            $table->longText('bill_information_data')->nullable();
            $table->text('total_amount_rupees')->nullable();
            $table->string('total_amount',100)->nullable();
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
        Schema::dropIfExists('bill_information');
    }
}
