<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchasemaster', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('companyid');
            $table->date('purchasedate');
            $table->decimal('purchaseqty', 10, 2);
            $table->decimal('parchaseweight', 10, 2);
            $table->decimal('rateofpurchase', 10, 2)->nullable();;
            $table->enum('status', ['open', 'close', 'reopen']);
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchasemaster');
    }
};
