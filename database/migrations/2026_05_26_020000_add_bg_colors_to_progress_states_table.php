<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('progress_states', function (Blueprint $table) {
            $table->string('bg_block_1')->default('default')->after('color_block_6');
            $table->string('bg_block_2')->default('default')->after('bg_block_1');
            $table->string('bg_block_3')->default('default')->after('bg_block_2');
            $table->string('bg_block_4')->default('default')->after('bg_block_3');
            $table->string('bg_block_5')->default('default')->after('bg_block_4');
            $table->string('bg_block_6')->default('default')->after('bg_block_5');
        });
    }

    public function down(): void
    {
        Schema::table('progress_states', function (Blueprint $table) {
            $table->dropColumn(['bg_block_1', 'bg_block_2', 'bg_block_3', 'bg_block_4', 'bg_block_5', 'bg_block_6']);
        });
    }
};
