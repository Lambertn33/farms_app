<?php

use App\Models\Farm_Season;
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
        Schema::create('farm__seasons', function (Blueprint $table) {
            $table->uuid('farmer_id');
            $table->uuid('season_id');
            $table->bigInteger('yield');
            $table->bigInteger('year');
            $table->enum('product', Farm_Season::PRODUCTS);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farm__seasons');
    }
};
