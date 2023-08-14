<?php

use App\Models\Farmer;
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
        Schema::create('farmers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->date('DOB');
            $table->enum('gender', Farmer::GENDER);
            $table->enum('marital_status', Farmer::MARITAL_STATUS);
            $table->integer('family_members');
            $table->enum('eduction_level', Farmer::EDUCATION_LEVELS);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farmers');
    }
};
