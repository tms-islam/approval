<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersRolesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_role_name');
            // $table->timestamps();
        });

        $roles = [
            ['user_role_name' => 'admin'],
            ['user_role_name' => 'licensor'],
            ['user_role_name' => 'licenses'],
        ];
        DB::table('users_roles')->insert($roles);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('users_roles');
    }

}
