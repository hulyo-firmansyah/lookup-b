<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsSpecsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_specs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spec_id')->constrained('specs')->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('product_id')->constrained('products')->onDelete('restrict')->onUpdate('restrict');
            $table->string('value', 255)->comment('Value for specs');
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
        Schema::dropIfExists('products_specs');
    }
}
