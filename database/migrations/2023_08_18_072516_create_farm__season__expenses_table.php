<?php

use App\Models\Farm_Season_Expense;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('farm__season__expenses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('yield_id');
            $table->enum('type', Farm_Season_Expense::EXPENSES_TYPES);
            $table->string('product');
            $table->bigInteger('quantity');
            $table->bigInteger('price');
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farm__season__expenses');
    }
};
