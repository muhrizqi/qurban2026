# ==============================================================
#  deploy.ps1  -  One-Click Deploy untuk Qurban 2026
#  Cara pakai:
#    .\deploy.ps1
#    .\deploy.ps1 "pesan commit custom"
# ==============================================================

$PHP  = "E:\laragon\bin\php\php-8.3.30-Win32-vs16-x64\php.exe"
$ROOT = $PSScriptRoot

function OK  ($m) { Write-Host "  [OK] $m"    -ForegroundColor Green  }
function WARN($m) { Write-Host "  [!!] $m"    -ForegroundColor Yellow }
function ERR ($m) { Write-Host "  [XX] $m"    -ForegroundColor Red    }
function HDR ($m) { Write-Host "`n==> $m"     -ForegroundColor Cyan   }

HDR "QURBAN 2026 - DEPLOY"
Write-Host "  $(Get-Date -Format 'dd/MM/yyyy HH:mm:ss')" -ForegroundColor DarkGray
Write-Host ""

# --- 1. Pesan commit -------------------------------------------
if ($args[0]) {
    $commitMsg = $args[0]
} else {
    $commitMsg = "chore: deploy $(Get-Date -Format 'dd-MM-yyyy HH:mm')"
}
Write-Host "  Pesan commit: $commitMsg" -ForegroundColor White

# --- 2. Cek ada perubahan? ------------------------------------
$changedFiles = git -C $ROOT status --porcelain
if (-not $changedFiles) {
    WARN "Tidak ada file yang berubah, langsung push..."
} else {
    # --- 3. Git add -------------------------------------------
    HDR "Git: Staging semua perubahan"
    git -C $ROOT add -A
    if ($LASTEXITCODE -ne 0) { ERR "git add gagal!"; exit 1 }
    OK "git add -A"

    # --- 4. Git commit ----------------------------------------
    HDR "Git: Commit"
    git -C $ROOT commit -m "$commitMsg"
    if ($LASTEXITCODE -ne 0) { ERR "git commit gagal!"; exit 1 }
    OK "git commit berhasil"
}

# --- 5. Git push ----------------------------------------------
HDR "Git: Push ke origin/main"
git -C $ROOT push origin main
if ($LASTEXITCODE -ne 0) { ERR "git push gagal!"; exit 1 }
OK "git push -> origin/main berhasil"

# --- 6. Clear cache lokal (Laragon) ---------------------------
HDR "Cache: Membersihkan cache lokal"
& $PHP "$ROOT\artisan" view:clear
OK "view:clear"
& $PHP "$ROOT\artisan" config:clear
OK "config:clear"
& $PHP "$ROOT\artisan" cache:clear
OK "cache:clear"

# --- 7. Selesai -----------------------------------------------
Write-Host ""
Write-Host "------------------------------------------------------" -ForegroundColor DarkGray
Write-Host "  DEPLOY SELESAI!" -ForegroundColor Green
Write-Host "  Easypanel akan otomatis rebuild & jalankan migrate." -ForegroundColor DarkGray
Write-Host "  Pantau progress di dashboard Easypanel Anda." -ForegroundColor DarkGray
Write-Host "------------------------------------------------------" -ForegroundColor DarkGray
Write-Host ""
