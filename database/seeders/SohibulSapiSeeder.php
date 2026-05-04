<?php

namespace Database\Seeders;

use App\Models\SohibulSapi;
use Illuminate\Database\Seeder;

class SohibulSapiSeeder extends Seeder
{
    /**
     * Seed 5 sohibul per jenis per RT/lokasi.
     *
     * Jenis    : REGULER, SUPER, DUPER, PRIBADI
     * RT       : 30 – 47 (warga) + non_warga
     * Total    : 4 jenis × 19 lokasi × 5 = 380 record
     */
    public function run(): void
    {
        $jenisAll = array_keys(SohibulSapi::JENIS_OPTIONS); // REGULER, SUPER, DUPER, PRIBADI
        $rts      = array_merge(array_map('strval', range(30, 47)), ['non_warga']);

        $posisiOpts  = array_keys(SohibulSapi::POSISI_OPTIONS);
        $bagianOpts  = array_keys(SohibulSapi::BAGIAN_OPTIONS);

        // Counter no_sohibul per jenis (supaya urut dan unik)
        $counters = [];
        foreach ($jenisAll as $jenis) {
            // Mulai dari angka setelah data yang sudah ada (jika ada)
            $prefix  = SohibulSapi::JENIS_PREFIX[$jenis] ?? '';
            $last    = SohibulSapi::where('jenis', $jenis)
                           ->orderByRaw('CAST(SUBSTRING(no_sohibul, ' . (strlen($prefix) + 1) . ') AS UNSIGNED) DESC')
                           ->value('no_sohibul');
            $counters[$jenis] = $last ? (int) substr($last, strlen($prefix)) : 0;
        }

        $namaDepan = [
            'Ahmad','Budi','Citra','Dewi','Eko','Fatimah','Galih','Hana',
            'Irfan','Joko','Kartika','Lutfi','Maya','Nanda','Omar',
            'Putri','Qodir','Rina','Sari','Tono','Umar','Vina',
            'Wahyu','Xenia','Yusuf','Zainab','Agus','Bagas','Candra',
            'Dian','Erna','Fajar','Gilang','Hasna','Ilham','Jumadi',
        ];
        $namaBlkng = [
            'Santoso','Wijaya','Setiawan','Rahayu','Susanto','Pratama',
            'Wibowo','Hidayat','Nugroho','Purnomo','Saputra','Kurniawan',
            'Lestari','Handoko','Hartono','Kusuma','Budiman','Firmansyah',
        ];
        $nohpPrefix = ['0812','0813','0821','0822','0851','0852','0853','0857','0878'];

        $records = [];

        foreach ($jenisAll as $jenis) {
            $prefix = SohibulSapi::JENIS_PREFIX[$jenis] ?? '';
            $nilaiDefault = SohibulSapi::NILAI_DEFAULT[$jenis];

            foreach ($rts as $rt) {
                $rw = $rt === 'non_warga'
                    ? null
                    : (SohibulSapi::RT_RW_MAP[$rt] ?? null);

                for ($i = 1; $i <= 5; $i++) {
                    $counters[$jenis]++;
                    $noSohibul = $prefix . $counters[$jenis];

                    $nama   = $namaDepan[array_rand($namaDepan)] . ' ' . $namaBlkng[array_rand($namaBlkng)];
                    $namaKk = $namaDepan[array_rand($namaDepan)] . ' ' . $namaBlkng[array_rand($namaBlkng)];

                    $nohp = $nohpPrefix[array_rand($nohpPrefix)]
                          . str_pad((string) rand(1000000, 9999999), 7, '0', STR_PAD_LEFT);

                    $alamat = $rt === 'non_warga'
                        ? 'Jl. Luar Jogokariyan No. ' . rand(1, 100) . ', Yogyakarta'
                        : 'Jl. Jogokariyan Gg. ' . chr(rand(65, 70)) . ' No. ' . rand(1, 50)
                          . ', RT ' . $rt . '/RW ' . ($rw ?? '-');

                    // Bagian distribusi
                    if ($rt === 'non_warga') {
                        $bagian = 'tidak_diambil';
                    } else {
                        $bagian = $bagianOpts[array_rand($bagianOpts)];
                    }

                    // Nilai sepertuju
                    $nilai = $jenis === 'PRIBADI'
                        ? (rand(0, 3) === 0 ? rand(5_000_000, 15_000_000) : $nilaiDefault)
                        : $nilaiDefault;

                    $records[] = [
                        'no_sohibul'    => $noSohibul,
                        'jenis'         => $jenis,
                        'nama'          => $nama,
                        'nama_kk'       => $namaKk,
                        'nohp'          => $nohp,
                        'alamat'        => $alamat,
                        'rt'            => $rt,
                        'rw'            => $rw,
                        'bagiansohibul' => $bagian,
                        'nilaisepertuju'=> $nilai,
                        'posisidana'    => $posisiOpts[array_rand($posisiOpts)],
                        'status'        => 0, // Selalu Belum Terkirim — status 1/2 butuh PJ
                        'kwitansi'      => null,
                        'urlmap'        => 'https://maps.google.com/?q='
                                          . (-7.8 + (rand(-500, 500) / 10000))
                                          . ','
                                          . (110.35 + (rand(-500, 500) / 10000)),
                        'keterangan'    => null,
                        'pj'            => null,
                        'created_at'    => now(),
                        'updated_at'    => now(),
                    ];
                }
            }
        }

        // Insert dalam batch 50 agar tidak timeout
        foreach (array_chunk($records, 50) as $batch) {
            SohibulSapi::insert($batch);
        }

        $this->command->info('✅ SohibulSapi seeder selesai: ' . count($records) . ' record ditambahkan.');
    }
}
