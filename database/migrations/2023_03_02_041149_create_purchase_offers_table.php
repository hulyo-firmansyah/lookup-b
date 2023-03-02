<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_offers', function (Blueprint $table) {
            $table->id();
            $table->string('tr_number', 60)->unique();
            $table->foreignId('vendor_id')->constrained('contacts')->onDelete('restrict')->onUpdate('restrict');
            $table->enum('vendor_type', ['vendor', 'agent']);
            $table->dateTime('tr_date');
            $table->dateTime('tr_due_date')->nullable();
            $table->bigInteger('total');
            $table->string('vendor_ref_number', 50)->nullable();
            $table->foreignId('pay_term_id')->constrained('payment_terms')->onDelete('restrict')->onUpdate('restrict');
            $table->text('memo')->nullable();
            $table->bigInteger('discount_value')->nullable();
            $table->enum('discount_type', ['before_tax', 'after_tax'])->nullable();
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
        Schema::dropIfExists('purchase_offers');
    }
}
