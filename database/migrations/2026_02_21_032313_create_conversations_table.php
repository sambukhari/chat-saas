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
       Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->foreignId('company_site_id')->constrained()->cascadeOnDelete();

            $table->string('status')->default('open'); // open/closed
            $table->foreignId('assigned_agent_id')->nullable()->constrained('agents')->nullOnDelete();

            $table->string('visitor_name')->nullable();
            $table->string('visitor_email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};
