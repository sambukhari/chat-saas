<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('company_sites', function (Blueprint $table) {
            $table->foreignId('company_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->string('domain');
            $table->string('widget_key');
            $table->boolean('is_active')->default(true);
        });
    }

    public function down(): void
    {
        Schema::table('company_sites', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropColumn(['company_id', 'domain', 'is_active']);
        });
    }
};