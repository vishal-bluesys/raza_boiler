<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->enum('usertype', ['customer', 'company']);
            $table->unsignedBigInteger('userid');
            $table->decimal('paymentamount', 15, 2);
            $table->enum('paymenttype', ['paid', 'received']);
            $table->enum('paymentmode', ['online', 'cash', 'cheque']);
            $table->string('transaction_cheque_no')->nullable();
            $table->date('paymentdate');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
