<?php

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
        Schema::create("repositories", function (Blueprint $table) {
            $table->ulid("id");
            $table->string("name");
            $table->string("description");
            $table->string("owner");
            $table->timestamp("createdAt");
            $table->timestamp("updatedAt");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop("repositories");
    }
};
