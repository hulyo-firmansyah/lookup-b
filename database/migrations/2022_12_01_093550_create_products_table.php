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
            $table->id('id');
            $table->string('product_code', 255)->comment('example MDB01. purpose is for product code or SKU');
            $table->integer('serial_number')->comment('for nomer urut or. cannot nullable, generate this automatically by system');
            $table->string('product_name', 300)->comment('product name');
            $table->integer('qty')->comment('quantity or stock')->nullable()->default(0);
            $table->integer('price')->comment('product price');
            $table->foreignId('brand_id')->constrained('brands')->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('warehouse_id')->constrained('warehouses')->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('unit_id')->constrained('units')->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('category_id')->constrained('categories')->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('sub_category_id')->constrained('sub_categories')->onDelete('restrict')->onUpdate('restrict')->nullable();
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
