<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Models\Concerns\HasActivity;
use Spatie\Activitylog\LogOptions;

class SohibulSapi extends Model
{
    use HasActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('Sohibul Sapi')
            ->setDescriptionForEvent(fn(string $eventName) => "{$eventName} sohibul " . ($this->no_sohibul ?? '-'));
    }

    protected $table = 'sohibul_sapi';

    protected $fillable = [
        'no_sohibul', 'noinvoice', 'nama', 'alamat', 'rt', 'rw',
        'bagiansohibul', 'nohp', 'nama_kk', 'jenis',
        'nilaisepertuju', 'kwitansi', 'urlmap', 'posisidana',
        'status', 'keterangan', 'pj',
    ];

    protected $casts = [
        'nilaisepertuju' => 'integer',
        'status'         => 'integer',
    ];

    // ── Konstanta ────────────────────────────────────────────────
    const JENIS_OPTIONS = ['REGULER' => 'REGULER', 'SUPER' => 'SUPER', 'DUPER' => 'DUPER', 'PRIBADI' => 'PRIBADI'];

    const JENIS_PREFIX  = ['REGULER' => 'R', 'SUPER' => 'S', 'DUPER' => 'D', 'PRIBADI' => 'PB'];

    const NILAI_DEFAULT = ['REGULER' => 3650000, 'SUPER' => 5500000, 'DUPER' => 10000000, 'PRIBADI' => null];

    const STATUS_LABEL  = [0 => 'Belum Terkirim', 1 => 'Dalam Proses', 2 => 'Selesai'];

    const STATUS_COLOR  = [0 => 'gray', 1 => 'warning', 2 => 'success'];

    const BAGIAN_OPTIONS = [
        'diambil_sendiri' => 'Diambil Sendiri',
        'tidak_diambil'   => 'Tidak Diambil',
        'diantarkan'      => 'Diantarkan',
    ];

    const POSISI_OPTIONS = ['Rek Program' => 'Rek Program', 'Rek Qurban' => 'Rek Qurban', 'Kas' => 'Kas'];

    // RT → RW map
    const RT_RW_MAP = [
        '30' => '9', '31' => '9', '32' => '9', '33' => '9',
        '34' => '10','35' => '10','36' => '10','37' => '10','38' => '10','39' => '10',
        '40' => '11','41' => '11','42' => '11','43' => '11',
        '44' => '12','45' => '12','46' => '12','47' => '12',
    ];

    // ── Helpers ──────────────────────────────────────────────────

    /**
     * Buat no_sohibul berikutnya untuk jenis tertentu.
     */
    public static function nextNoSohibul(string $jenis): string
    {
        $prefix = self::JENIS_PREFIX[$jenis] ?? '';
        
        $maxNo = self::where('jenis', $jenis)->get()->max(function ($model) use ($prefix) {
            return (int) substr($model->no_sohibul, strlen($prefix));
        });
        
        $lastNo = $maxNo ?: 0;
        return $prefix . ($lastNo + 1);
    }

    // ── Relasi ───────────────────────────────────────────────────
    public function penanggungJawab(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pj');
    }
}
