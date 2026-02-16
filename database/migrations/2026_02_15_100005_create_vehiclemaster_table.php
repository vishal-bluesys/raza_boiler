<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehiclemaster', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicletype');
            $table->string('vehicalid')->nullable();
            $table->string('rcnumber')->nullable();
            $table->string('vehicalmodel')->nullable();
            $table->string('ownername')->nullable();
            $table->string('owneraddress')->nullable();
            $table->date('dateofjoining')->nullable();
            $table->string('contactpersonname')->nullable();
            $table->string('contactperson_number', 20)->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign('vehicletype')->references('id')->on('vehicletypemaster')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehiclemaster');
    }
};
