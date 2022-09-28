<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', static function (Blueprint $table) {
            $table->id();
            $table->string('transactionID');
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('academic_year_id');
            $table->string('payerName');
            $table->string('payerIDCard');
            $table->string('payerPhoneNumber');
            $table->enum('type', ['discharge-all', 'discharge-first-part', 'discharge-second-part',  'medicalVisit']); //Supported type
            $table->integer('amount');
            $table->timestamp('payAt');
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
        Schema::dropIfExists('payments');
    }
}
