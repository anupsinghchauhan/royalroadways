<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billings', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('lr_mode')->nullable();
            $table->string('royal_email',100)->nullable();
            $table->integer('lrno')->nullable();
            $table->string('truckno',50)->nullable();
            $table->dateTime('royal_date')->nullable();
            $table->string('royal_from',100)->nullable();
            $table->string('royal_to',100)->nullable();
            $table->text('driver_details')->nullable();
            $table->string('consignor1')->nullable();
            $table->string('consignee1')->nullable();
            $table->string('consignor_add_1')->nullable();
            $table->string('consignor_add_2')->nullable();
            $table->string('consignee_add_1')->nullable();
            $table->string('consignee_add_2')->nullable();
            $table->string('gstin1')->nullable();
            $table->string('gstin2')->nullable();
            $table->string('no1')->nullable();
            $table->text('nogstc1')->nullable();
            $table->string('weight1',50)->nullable();
            $table->string('rate1',50)->nullable();
            $table->string('total_freighty_to_opay1',50)->nullable();
            $table->string('royal_amount',10)->nullable();
            $table->string('transport',1)->nullable();
            $table->string('cdst',10)->nullable();
            $table->string('sgst',10)->nullable();
            $table->string('total_amount',10)->nullable();
            $table->string('consignor',1)->nullable();
            $table->string('consignee',1)->nullable();
            $table->string('ToPayOrPaid',200)->nullable();
            $table->longText('pdf_file')->nullable();
            $table->string('pdf_name',255)->nullable();
            $table->string('UnpaidParty',10)->nullable()->comment('Consignor/Consignee/blank = no one');
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
        Schema::dropIfExists('billings');
    }
}
