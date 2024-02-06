<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('user_type_id')->nullable();
            $table->string('user_name',100)->nullable();
            $table->string('name',100)->nullable();
            $table->string('email',150)->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('truck_no')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('user_type_id')->references('id')->on('user_types')->onDelete('cascade');;
        });

        // Insert some stuff
        DB::table('users')->insert(
            array(
                'user_type_id' => '1',
                'name' => 'royalroadways',
                'email' => 'husenchudesara@gmail.com',
                'password' => Hash::make('ROYAL@8655')
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
