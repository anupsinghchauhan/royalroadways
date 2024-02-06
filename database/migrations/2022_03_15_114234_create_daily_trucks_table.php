<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyTrucksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_trucks', function (Blueprint $table) {

            $table->id();
            $table->string('daily_trucks_to',200)->nullable();
            $table->string('daily_trucks_from',200)->nullable();
            $table->string('truck_no',100)->nullable();
            $table->dateTime('daily_trucks_date')->nullable();
            $table->string('party_name',100)->nullable();
            $table->string('daily_trucks_rate',50)->nullable();
            $table->string('daily_trucks_materials',200)->nullable();
            $table->string('pay_status',10)->nullable();
            $table->string('driver_mobile',50)->nullable();
            $table->string('transport',200)->nullable();
            $table->string('daily_trucks_advance',200)->nullable();
            $table->integer('daily_trucks_commission')->nullable();
            $table->string('daily_trucks_weight',200)->nullable();
            $table->string('daily_trucks_total',200)->nullable();
            $table->string('daily_trucks_balance',200)->nullable();
            $table->string('daily_trucks_diesel',100)->nullable();
            $table->text('daily_trucks_remark')->nullable();
            $table->string('expense',100)->nullable();
            $table->text('expense_details')->nullable();
            $table->string('mode_type',1)->default('D')->nullable();
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
        Schema::dropIfExists('daily_trucks');
    }
}
