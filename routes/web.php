<?php

use App\Models\SohibulSapi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;

// ── Healthcheck ringan (tidak menyentuh database) ────────────────────────────
// Digunakan oleh serversideup PHP image untuk memverifikasi PHP-FPM hidup.
Route::get('/healthcheck', function () {
    return response('OK', 200)->header('Content-Type', 'text/plain');
});

Route::get('/', function () {
    return view('lewat');
});

Route::get('/sohibul/{sohibul}/kuitansi-pdf', function (SohibulSapi $sohibul) {
    if (!auth()->check()) abort(403);
    
    // Set locale ke Indonesia untuk tanggal
    \Carbon\Carbon::setLocale('id');
    
    $pdf = Pdf::loadView('pdf.kuitansi', ['sohibul' => $sohibul]);
    return $pdf->stream('kuitansi-' . $sohibul->no_sohibul . '.pdf');
})->name('sohibul.kuitansi.pdf')->middleware(['auth']);

Route::get('/publik/sohibul', function () {
    return view('publik-sohibul');
})->name('sohibul.publik');
