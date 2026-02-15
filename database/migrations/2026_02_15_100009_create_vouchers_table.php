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
            $table->unsignedBigInteger('Vouchertype');
            $table->string('employeename')->nullable();
            $table->unsignedBigInteger('employeeid')->nullable();
            $table->decimal('Voucheramount', 15, 2)->default(0);
            $table->timestamp('created_at')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();

            $table->foreign('Vouchertype')->references('id')->on('vouchers_type')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
