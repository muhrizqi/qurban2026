<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgressLog extends Model
{
    protected $table = 'progress_logs';

    protected $fillable = ['state'];

    protected $casts = [
        'state' => 'array',
    ];
}
