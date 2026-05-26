<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('progress_states', function (Blueprint $table) {
            $table->string('theme')->default('dark')->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('progress_states', function (Blueprint $table) {
            $table->dropColumn('theme');
        });
    }
};
