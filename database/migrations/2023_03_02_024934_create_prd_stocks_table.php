<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrdStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prd_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('warehouse_id')->nullable()->constrained('warehouses')->onDelete('set null')->onUpdate('set null');
            $table->integer('value')->nullable()->default(0);
            $table->enum('type', ['0', '1'])->nullable()->default('0');
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
        Schema::dropIfExists('prd_stocks');
    }
}
