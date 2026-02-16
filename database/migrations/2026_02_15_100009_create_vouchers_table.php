<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vouchertype');
            $table->string('vouchernumber')->nullable();
            $table->string('employeename')->nullable();
            $table->unsignedBigInteger('employeeid')->nullable();
            $table->decimal('voucheramount', 15, 2)->default(0);
            $table->timestamp('created_at')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->foreign('vouchertype')->references('id')->on('vouchers_type')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
