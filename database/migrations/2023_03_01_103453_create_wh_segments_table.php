<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWhSegmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wh_segments', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique()->nullable();
            $table->text('image_path')->nullable();
            $table->string('name', 100);
            $table->text('details')->nullable();
            $table->foreignId('wh_id')->constrained('warehouses')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('type_id')->constrained('wh_segtypes')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('wh_segments');
    }
}
