<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sohibul_sapi', function (Blueprint $table) {
            $table->id();
            $table->string('no_sohibul', 20)->unique();
            $table->string('nama');
            $table->text('alamat');
            $table->string('rt', 15);   // '30'-'47' atau 'non_warga'
            $table->string('rw', 5)->nullable(); // '9'-'12' atau null
            $table->enum('bagiansohibul', ['diambil_sendiri', 'tidak_diambil', 'diantarkan'])
                  ->default('diantarkan');
            $table->string('nohp', 20)->nullable();
            $table->string('nama_kk');
            $table->enum('jenis', ['REGULER', 'SUPER', 'DUPER', 'PRIBADI']);
            $table->unsignedBigInteger('nilaisepertuju')->nullable();
            $table->string('kwitansi')->nullable();  // path file
            $table->string('urlmap', 500)->nullable();
            $table->enum('posisidana', ['Rek Program', 'Rek Qurban', 'Kas']);
            $table->tinyInteger('status')->default(0); // 0=belum, 1=proses, 2=selesai
            $table->text('keterangan')->nullable();
            $table->foreignId('pj')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sohibul_sapi');
    }
};
