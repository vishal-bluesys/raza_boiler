<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('saleitems', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('saleid');
            $table->unsignedBigInteger('itemid');
            $table->decimal('itemweight', 10, 2);
            $table->integer('itemqty');
            $table->decimal('actualrate', 10, 2);
            $table->decimal('salerate', 10, 2);
            $table->enum('discounttype', ['flat', 'percent']);
            $table->decimal('discount', 10, 2);
            $table->decimal('totalsale', 10, 2);
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saleitems');
    }
};
