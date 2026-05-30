# Si Tania — AGENTS.md

TOPSIS-based crop recommendation system (Laravel 10). MySQL only, no SQLite.

## Setup

```bash
cp .env.example .env          # edit DB_DATABASE, DB_USERNAME, DB_PASSWORD
composer install && npm install
php artisan key:generate
php artisan migrate
php artisan db:seed            # order: AdminSeeder → KriteriaSeeder → WargaSeeder
npm run dev                    # vite dev server
```

Served at `http://localhost/si_tania/public` (Laragon). `.env` `APP_URL` must match.

## Seeds & credentials

| Seeder | Login |
|---|---|
| `AdminSeeder` | admin@gmail.com / admin123 (role: admin) |
| `WargaSeeder` | warga@gmail.com / warga123 (role: user) |
| `KriteriaSeeder` | 7 rows K1–K7 with bobot (K1=0.30 .. K7=0.03) |

## Routes (`routes/web.php`)

- Guest: `/login`, `/login/admin`, `/register`, `/forgot-password`
- `role:user` → `/warga/*` (beranda, input-lahan, riwayat, profil)
- `role:admin` → `/admin/*` (beranda, kriteria CRUD, tanaman CRUD, data-warga, profil)
- `RoleMiddleware` (`Kernel.php:57`) checks `auth()->user()->role !== $role`, alias `role`

## Core flow (`InputDataLahanController::simpanInput`)

1. Validate 7 fields — `jenis_tanah` (string), K2–K7 (numeric)
2. Save `RiwayatInput` with per-user sequential `urutan` (max+1)
3. Fetch `Kriteria::orderBy('kode')` — bobot read from table, **`app/Services/AHP.php` is never called**
4. Fetch `AlternatifTanaman::where('status', 'aktif')` with `detail.kriteria`
5. `TOPSIS::ranking()` — 10 if input ∈ [nilai_min, nilai_max], linear decay with 20% tolerance outside (floor 1), then full TOPSIS pipeline; returns sorted array with `vi`, `ranking`, `metode_budidaya`
6. Persist `HasilRekomendasi` per plant, redirect to riwayat detail

## Models

- `Kriteria` — `kode` (K1..K7), `bobot` (seeded, not computed at runtime)
- `AlternatifTanaman` — `status` ('aktif'/'nonaktif'), `metode_budidaya`
- `DetailTanaman` — `nilai_min`, `nilai_max`, `nilai_optimal` per `kriteria_id`
- `RiwayatInput` — `hasil()` is `hasMany(HasilRekomendasi)->orderBy('ranking')`
- `HasFactory` trait is commented out on all models except `User`

## Services

| File | Status |
|---|---|
| `app/Services/AHP.php` | Exists, **unused** in runtime (bobot read from DB) |
| `app/Services/TOPSIS.php` | `hitungSkor()` + `ranking()`, called from controller |

## Testing

```bash
php artisan test              # PHPUnit Unit + Feature
./vendor/bin/pint             # PSR-12 fixer
```

`phpunit.xml` targets **MySQL** (SQLite lines commented out). Only boilerplate tests exist.

## Quirks

- **Directory casing**: `app/services/` directory is lowercase but PSR-4 expects `app/Services/`. Works on Windows (case-insensitive); **will fail autoloading on Linux/macOS**. If deploying to *nix, rename dir to `Services/`.
- `K1` (Jenis Tanah) is string; K2–K7 are numeric. Adding/removing criteria requires changes in form, validation, controller, seeder, and TOPSIS key mapping.
- `RiwayatInput` displays per-user `urutan` (not `id`), set manually via `max('urutan') + 1`. Column added late via `2026_05_17_000001`.
- No email delivery configured (Mailpit SMTP default in `.env.example`).
