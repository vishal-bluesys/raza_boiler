<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintanance', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicleid');
            $table->unsignedBigInteger('maintanancetype');
            $table->decimal('maintanancecost', 15, 2)->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign('vehicleid')->references('id')->on('vehiclemaster')->onDelete('cascade');
            $table->foreign('maintanancetype')->references('id')->on('maitainancetype')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintanance');
    }
};
