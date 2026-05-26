<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgressState extends Model
{
    protected $table = 'progress_states';

    protected $guarded = [];

    protected $casts = [
        'penyembelihan_sapi_time' => 'datetime',
        'penyembelihan_kambing_time' => 'datetime',
        'pengeletan_sapi_time' => 'datetime',
        'pengeletan_kambing_time' => 'datetime',
        'penimbangan_sapi_reguler_time' => 'datetime',
        'penimbangan_sapi_khusus_time' => 'datetime',
        'penimbangan_kambing_time' => 'datetime',
        'sohibul_sapi_reguler_terbungkus_time' => 'datetime',
        'sohibul_sapi_reguler_terdistribusi_time' => 'datetime',
        'sohibul_sapi_khusus_terbungkus_time' => 'datetime',
        'sohibul_sapi_khusus_terdistribusi_time' => 'datetime',
        'sohibul_kambing_terbungkus_time' => 'datetime',
        'sohibul_kambing_terdistribusi_time' => 'datetime',
        'bungkusan_daging_terbungkus_time' => 'datetime',
        'bungkusan_daging_terdistribusi_time' => 'datetime',
    ];

    public static function getSingle(): self
    {
        return self::firstOrCreate(
            ['id' => 1],
            [
                'theme' => 'dark',
                'color_block_1' => 'emerald',
                'color_block_2' => 'indigo',
                'color_block_3' => 'violet',
                'color_block_4' => 'rose',
                'color_block_5' => 'amber',
                'color_block_6' => 'sky',
                'bg_block_1' => 'default',
                'bg_block_2' => 'default',
                'bg_block_3' => 'default',
                'bg_block_4' => 'default',
                'bg_block_5' => 'default',
                'bg_block_6' => 'default',
            ]
        );
    }

    protected static function booted()
    {
        // Whenever the progress state is updated, log the new snapshot
        static::updated(function ($progressState) {
            ProgressLog::create([
                'state' => $progressState->toArray(),
            ]);
        });
    }
}
