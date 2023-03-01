<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePContactTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_contact_type', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50);
            $table->foreignId('contact_id')->nullable()->constrained('contacts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('contact_type_id')->constrained('contact_types')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('p_contact_type');
    }
}
