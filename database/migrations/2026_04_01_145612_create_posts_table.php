<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {

            $table->id();

            // Relation with users table
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('title');

            $table->text('desc');

            $table->text('image')->nullable();

            // created_at & updated_at
            $table->timestamps();

            // add deleted_at column for soft deletes
            $table->softDeletes(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};