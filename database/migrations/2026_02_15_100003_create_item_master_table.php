<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_master', function (Blueprint $table) {
            $table->id();
            $table->string('itemname');
            $table->string('itemslug')->unique();
            $table->unsignedBigInteger('customertypeid');
            $table->timestamps();

            $table->foreign('customertypeid')->references('id')->on('customertype')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_master');
    }
};
