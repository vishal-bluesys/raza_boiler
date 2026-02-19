<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orderitems', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orderid');
            $table->unsignedBigInteger('itemid');
            $table->decimal('itemweight', 10, 2);
            $table->enum('status', ['ordered', 'canceled']);
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orderitems');
    }
};
