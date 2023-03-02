<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePPrcDelivTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_prc_deliv_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pd_id')->constrained('purchase_deliveries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('tag_id')->constrained('tags')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('p_prc_deliv_tag');
    }
}
