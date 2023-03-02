<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePPrcOfferPrdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_prc_offer_prd', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('transaction_id')->constrained('purchase_offers')->onDelete('restrict')->onUpdate('restrict');
            $table->integer('qty');
            $table->foreignId('tax_id')->nullable()->constrained('taxes')->onDelete('restrict')->onUpdate('restrict');
            $table->bigInteger('purchase_price')->nullable();
            $table->boolean('is_price_include_tax')->default(false)->nullable();
            $table->bigInteger('discount_value')->nullable();
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
        Schema::dropIfExists('p_prc_offer_prd');
    }
}
