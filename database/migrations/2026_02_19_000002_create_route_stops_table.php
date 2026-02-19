<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('route_stops', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('routeid');
            $table->unsignedBigInteger('customerid');
            $table->unsignedBigInteger('itemid');
            $table->decimal('itemqty', 10, 2);
            $table->decimal('itemweight', 10, 2);
            $table->decimal('rateofsale', 10, 2)->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('route_stops');
    }
};
