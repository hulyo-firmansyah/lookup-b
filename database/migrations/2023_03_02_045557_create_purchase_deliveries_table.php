<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_deliveries', function (Blueprint $table) {
            $table->id();
            $table->string('tr_number', 60)->unique();
            $table->foreignId('transaction_ref_id')->constrained('purchase_orders')->onDelete('restrict')->onUpdate('restrict');
            $table->dateTime('delivery_date');
            $table->bigInteger('deliv_fee')->nullable();
            $table->text('memo')->nullable();
            $table->foreignId('shipping_list_id')->nullable()->constrained('shipping_lists')->onDelete('restrict')->onUpdate('restrict');
            $table->string('receipt_number', 50)->nullable();
            $table->foreignId('attachment_id')->nullable()->constrained('attachments')->onDelete('set null')->onUpdate('set null');
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
        Schema::dropIfExists('purchase_deliveries');
    }
}
