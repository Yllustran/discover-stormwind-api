<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('image')->nullable();
            $table->timestamps();
            $table->foreignId('place_id')->constrained('places')->onDelete('cascade'); // Relation with Places
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
