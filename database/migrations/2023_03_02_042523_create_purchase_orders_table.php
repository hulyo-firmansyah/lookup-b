<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('tr_number', 60)->unique();
            $table->foreignId('vendor_id')->constrained('contacts')->onDelete('restrict')->onUpdate('restrict');
            $table->enum('vendor_type', ['vendor', 'agent']);
            $table->foreignId('ref_id')->nullable()->constrained('purchase_requests')->onDelete('set null')->onUpdate('set null');
            $table->dateTime('tr_date');
            $table->dateTime('tr_due_date')->nullable();
            $table->bigInteger('dp_value')->nullable();
            $table->string('vendor_ref_number', 50)->nullable();
            $table->foreignId('pay_term_id')->constrained('payment_terms')->onDelete('restrict')->onUpdate('restrict');
            $table->bigInteger('wh_id')->unsigned()->nullable();
            $table->foreign('wh_id', 'wh_id_warehouses')->references('id')->on('warehouses')->onDelete('set null')->onUpdate('set null');
            $table->foreign('wh_id', 'wh_id_wh_segments')->references('id')->on('wh_segments')->onDelete('set null')->onUpdate('set null');
            $table->enum('wh_type', ['wh', 'segment'])->default('wh')->nullable();
            $table->bigInteger('total_tax')->nullable();
            $table->bigInteger('discount_value')->nullable();
            $table->enum('discount_type', ['before_tax', 'after_tax'])->nullable();
            $table->bigInteger('total')->nullable();
            $table->text('memo')->nullable();
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
        Schema::dropIfExists('purchase_orders');
    }
}
