<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_requests', function (Blueprint $table) {
            $table->id();
            $table->string('tr_number', 60)->unique();
            $table->foreignId('staff_id')->constrained('users')->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('vendor_id')->nullable()->constrained('contacts')->onDelete('restrict')->onUpdate('restrict');
            $table->enum('vendor_type', ['vendor', 'agent'])->nullable();
            $table->dateTime('tr_date');
            $table->dateTime('tr_due_date')->nullable();
            $table->text('memo')->nullable();
            $table->enum('urgency', ['l', 'm', 'h'])->nullable();
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
        Schema::dropIfExists('purchase_requests');
    }
}
