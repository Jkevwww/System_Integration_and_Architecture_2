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
        Schema::create('tools', function (Blueprint $table) {
            $table->id();
            $table->string('tool_name');
            $table->string('category');
            $table->string('serial_number')->unique();
            $table->decimal('price', 10, 2);
            $table->date('purchase_date');
            $table->string('status')->default('available');
            $table->string('storage_location');
            $table->string('assigned_to')->nullable();
            
            // New Bonus Fields
            $table->string('image_path')->nullable(); // Local upload
            $table->string('image_url')->nullable();  // External link
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tools');
    }
};
