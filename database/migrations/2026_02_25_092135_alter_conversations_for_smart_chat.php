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
        Schema::table('conversations', function (Blueprint $table) {
            $table->foreignId('assigned_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('handled_by', ['human', 'ai'])->nullable();
            $table->timestamp('assigned_at')->nullable();
            $table->timestamp('ai_started_at')->nullable();
            $table->integer('unread_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
