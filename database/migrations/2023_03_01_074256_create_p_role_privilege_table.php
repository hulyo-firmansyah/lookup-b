<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePRolePrivilegeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_role_privilege', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained('user_roles')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('privileges_id')->constrained('privilege_lists')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('p_role_privilege');
    }
}
