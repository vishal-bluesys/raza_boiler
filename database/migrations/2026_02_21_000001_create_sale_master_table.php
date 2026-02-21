<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sale_master', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customerid');
            $table->date('saledate');
            $table->enum('salestatus', ['open', 'close', 'reopen']);
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sale_master');
    }
};
