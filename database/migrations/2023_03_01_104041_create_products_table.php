<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->string('code', 50)->unique()->nullable();
            $table->string('brand', 30)->nullable();
            $table->text('description')->nullable();
            $table->foreignId('unit_id')->constrained('prd_units')->onDelete('restrict')->onUpdate('restrict');
            $table->bigInteger('buy_price');
            $table->bigInteger('sell_price');
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
        Schema::dropIfExists('products');
    }
}
