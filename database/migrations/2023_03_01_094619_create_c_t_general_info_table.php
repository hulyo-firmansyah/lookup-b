<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCTGeneralInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ct_general_info', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_id')->constrained('contacts')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('noun', ['0', '1', '2'])->nullable();
            $table->string('first_name', 100)->nullable();
            $table->string('middle_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->enum('identity', ['ktp', 'sim', 'passport', 'others'])->nullable();
            $table->string('identity_number', 50)->nullable();
            $table->string('company_name', 100)->nullable();
            $table->string('phone_num', 30)->nullable();
            $table->string('tax_id', 50)->nullable();
            $table->text('billing_address')->nullable();
            $table->text('sent_address')->nullable();
            $table->text('details')->nullable();
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
        Schema::dropIfExists('ct_general_info');
    }
}
