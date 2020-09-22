<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name');
            $table->string('username');
            $table->string('password')->nullable();
            $table->string('email');
            $table->string('phone')->nullable();
            $table->enum('usertype',['admin','customer'])->nullable();
            $table->enum('gender',['male','female','others'])->nullable();
            $table->text('image')->nullable();
            $table->dateTime('created_at')->nullable();
        });

        DB::table('users')->insert(
            array(
                'name' => 'Admin',
                'email'=> 'admin@email.com',
                'phone'=> '90000000000',
                'username' => 'admin',
                'usertype' => 'admin',
                'password' => md5('admin'),
                'gender'    => 'male',
                'created_at'=> date("Y-m-d H:i:s")
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
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
