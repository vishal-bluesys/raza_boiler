<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('route_builder', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicleid');
            $table->unsignedBigInteger('driverid');
            $table->date('deliverydate');
            $table->enum('status', ['delivered', 'canceled', 'intransit']);
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('route_builder');
    }
};
