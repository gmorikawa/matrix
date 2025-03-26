<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("projects", function (Blueprint $table) {
            $table->ulid("id");
            $table->string("name", 127);
            $table->string("description", 511)->nullable();
            $table->foreignUlid("owner_id");
            $table->timestamp("createdAt");
            $table->timestamp("updatedAt");
        });
    }

    public function down(): void
    {
        Schema::drop("projects");
    }
};
