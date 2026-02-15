<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer_master', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->unsignedBigInteger('customer_typeid');
            $table->string('customer_mobile', 20)->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_owner_name')->nullable();
            $table->string('customer_alternate_number', 20)->nullable();
            $table->string('customer_location')->nullable();
            $table->decimal('totalsaleinkg', 12, 2)->default(0);
            $table->decimal('totalbuisness', 15, 2)->default(0);
            $table->decimal('totalbalance', 15, 2)->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();

            //$table->foreign('customer_typeid')->references('id')->on('customertype')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_master');
    }
};
