<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('user_role');
            $table->integer('status');
            $table->string('activate_key');
            $table->integer('created_user');
            $table->integer('licens');
            $table->rememberToken();
            $table->timestamps();
        });

        //add admin and licensor and licenses 

        $admin = [
            ['name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => '$2y$10$7Nk.ei6TvHmo7DosMsjuTu2oaXMgRPIYz/SKAwPmKEdx8BTjaqfMC',
                'user_role' => 1,
                'status' => 1,
                'activate_key' => 'null',
                'created_user' => 1,
                'licens' => 1],
            ['name' => 'licensor',
                'email' => 'licensor@admin.com',
                'password' => '$2y$10$7Nk.ei6TvHmo7DosMsjuTu2oaXMgRPIYz/SKAwPmKEdx8BTjaqfMC',
                'user_role' => 2,
                'status' => 1,
                'activate_key' => 'null',
                'created_user' => 1,
                'licens' => 1],
            ['name' => 'lisenses',
                'email' => 'lisenses@admin.com',
                'password' => '$2y$10$7Nk.ei6TvHmo7DosMsjuTu2oaXMgRPIYz/SKAwPmKEdx8BTjaqfMC',
                'user_role' => 3,
                'status' => 1,
                'activate_key' => 'null',
                'created_user' => 1,
                'licens' => 2]
        ];
        DB::table('admins')->insert($admin);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('admins');
    }

}
