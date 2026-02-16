<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('company_master', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('company_mobile', 20)->nullable();
            $table->string('company_email')->nullable();
            $table->string('company_owner_name')->nullable();
            $table->string('company_gst_number', 100)->nullable();
            $table->string('company_location')->nullable();
            $table->decimal('totalpurchaseinkg', 12, 2)->default(0);
            $table->decimal('totalbuisness', 15, 2)->default(0);
            $table->decimal('totalbalance', 15, 2)->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_master');
    }
};
