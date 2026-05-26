<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('progress_states', function (Blueprint $table) {
            $table->id();
            
            // Block 1: Penyembelihan
            $table->integer('penyembelihan_sapi_tersembelih')->default(0);
            $table->integer('penyembelihan_sapi_total')->default(0);
            $table->timestamp('penyembelihan_sapi_time')->nullable();
            $table->integer('penyembelihan_kambing_tersembelih')->default(0);
            $table->integer('penyembelihan_kambing_total')->default(0);
            $table->timestamp('penyembelihan_kambing_time')->nullable();

            // Block 2: Pengeletan
            $table->integer('pengeletan_sapi_terkelet')->default(0);
            $table->integer('pengeletan_sapi_total')->default(0);
            $table->timestamp('pengeletan_sapi_time')->nullable();
            $table->integer('pengeletan_kambing_terkelet')->default(0);
            $table->integer('pengeletan_kambing_total')->default(0);
            $table->timestamp('pengeletan_kambing_time')->nullable();

            // Block 3: Penimbangan
            $table->integer('penimbangan_sapi_reguler_tertimbang')->default(0);
            $table->integer('penimbangan_sapi_reguler_total')->default(0);
            $table->timestamp('penimbangan_sapi_reguler_time')->nullable();
            $table->integer('penimbangan_sapi_khusus_tertimbang')->default(0);
            $table->integer('penimbangan_sapi_khusus_total')->default(0);
            $table->timestamp('penimbangan_sapi_khusus_time')->nullable();
            $table->integer('penimbangan_kambing_tertimbang')->default(0);
            $table->integer('penimbangan_kambing_total')->default(0);
            $table->timestamp('penimbangan_kambing_time')->nullable();

            // Block 4: Sohibul Qurban Sapi
            $table->integer('sohibul_sapi_reguler_terbungkus')->default(0);
            $table->integer('sohibul_sapi_reguler_total')->default(0);
            $table->integer('sohibul_sapi_reguler_tidak_diambil')->default(0);
            $table->integer('sohibul_sapi_reguler_terdistribusi')->default(0);
            $table->timestamp('sohibul_sapi_reguler_terbungkus_time')->nullable();
            $table->timestamp('sohibul_sapi_reguler_terdistribusi_time')->nullable();

            $table->integer('sohibul_sapi_khusus_terbungkus')->default(0);
            $table->integer('sohibul_sapi_khusus_total')->default(0);
            $table->integer('sohibul_sapi_khusus_tidak_diambil')->default(0);
            $table->integer('sohibul_sapi_khusus_terdistribusi')->default(0);
            $table->timestamp('sohibul_sapi_khusus_terbungkus_time')->nullable();
            $table->timestamp('sohibul_sapi_khusus_terdistribusi_time')->nullable();

            // Block 5: Sohibul Qurban Kambing
            $table->integer('sohibul_kambing_terbungkus')->default(0);
            $table->integer('sohibul_kambing_total')->default(0);
            $table->integer('sohibul_kambing_terdistribusi')->default(0);
            $table->timestamp('sohibul_kambing_terbungkus_time')->nullable();
            $table->timestamp('sohibul_kambing_terdistribusi_time')->nullable();

            // Block 6: Distribusi Bungkus Daging
            $table->integer('bungkusan_daging_terbungkus')->default(0);
            $table->integer('bungkusan_daging_total')->default(0);
            $table->integer('bungkusan_daging_terdistribusi')->default(0);
            $table->timestamp('bungkusan_daging_terbungkus_time')->nullable();
            $table->timestamp('bungkusan_daging_terdistribusi_time')->nullable();

            // Block Colors Configuration
            $table->string('color_block_1')->default('emerald');
            $table->string('color_block_2')->default('indigo');
            $table->string('color_block_3')->default('violet');
            $table->string('color_block_4')->default('rose');
            $table->string('color_block_5')->default('amber');
            $table->string('color_block_6')->default('sky');

            $table->timestamps();
        });

        Schema::create('progress_logs', function (Blueprint $table) {
            $table->id();
            $table->json('state');
            $table->timestamps();
        });

        // Seed the initial state row
        DB::table('progress_states')->insert([
            'id' => 1,
            'color_block_1' => 'emerald',
            'color_block_2' => 'indigo',
            'color_block_3' => 'violet',
            'color_block_4' => 'rose',
            'color_block_5' => 'amber',
            'color_block_6' => 'sky',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed Spatie role: adminprogres
        try {
            DB::table('roles')->insertOrIgnore([
                'name' => 'adminprogres',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } catch (\Exception $e) {
            // Ignore if roles table doesn't exist yet
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('progress_states');
        Schema::dropIfExists('progress_logs');
    }
};
