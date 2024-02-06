<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTruckExpenseCalculatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('truck_expense_calculates', function (Blueprint $table) {
            $table->id();
            $table->string('truck_no',50)->nullable();
            $table->dateTime('expense_date')->nullable();
            $table->string('expense_to',100)->nullable();
            $table->string('expense_from',100)->nullable();
            $table->string('expense_material',100)->nullable();
            $table->string('diesel_amount',100)->nullable();
            $table->string('expense_money',100)->comment('Rate')->nullable();
            $table->string('expense_payment_mode',50)->nullable();
            $table->string('expense_money_adv_taken',50)->nullable();
            $table->integer('money_return')->nullable();
            $table->integer('expense')->comment('kharch')->nullable();
            $table->string('expense_details',100)->comment('kharch details')->nullable();
            $table->string('expense_km',50)->nullable();
            $table->string('expense_diesel',50)->nullable();
            $table->string('is_calculated',1)->default('0')->comment('0 = no, 1 = yes');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('truck_expense_calculates');
    }
}
