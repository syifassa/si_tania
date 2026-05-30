# Test Matrix — Si Tania TOPSIS

> **Update**: Kolom `skor` dihapus dari perhitungan. Semua base skor = 9.0.
> Fungsi `hitungSkor` menggunakan degradasi linear kontinu.
> Dalam range: 9 → 5 (dari optimal ke batas range).
> Di luar range: 5 → 1 (dalam toleransi 30% range).

## Bobot Kriteria

| Kode | Nama | Bobot |
|------|------|-------|
| K1 | Jenis Tanah | 0.30 |
| K2 | pH Air | 0.21 |
| K3 | Suhu | 0.17 |
| K4 | Kelembapan Udara | 0.11 |
| K5 | Intensitas Cahaya | 0.10 |
| K6 | Curah Hujan Tahunan | 0.08 |
| K7 | Luas Lahan | 0.03 |

---

## Input (nilai dropdown)

| Kriteria | Sangat Baik | Baik | Cukup | Kurang |
|----------|-------------|------|-------|--------|
| K1 | 6.25 | 5.85 | 5.6 | 5.0 |
| K2 | 7.0 | 6.2 | 5.7 | 5.0 |
| K3 | 27.5 | 24.5 | 32.5 | 22 |
| K4 | 72.5 | 85.5 | 93 | 97 |
| K5 | 9 | 6.5 | 4.5 | 2 |
| K6 | 1800 | 1450 | 1150 | 800 |
| K7 | (manual) | — | — | — |

---

## Skenario Test

### 1. Ideal — Semua Sangat Baik

| K1 | K2 | K3 | K4 | K5 | K6 | K7 |
|----|----|----|----|----|----|----|
| 6.25 | 7.0 | 27.5 | 72.5 | 9 | 1800 | 150 |

| # | Tanaman | vi | % |
|---|---------|----|---|
| 1 | Pisang | 0.8671 | 86.71% |
| 2 | Kangkung | 0.7938 | 79.38% |
| 3 | Pepaya | 0.6865 | 68.65% |
| 4 | Cabai | 0.6566 | 65.66% |
| 5 | Bayam | 0.5731 | 57.31% |
| 6 | Tomat | 0.4805 | 48.05% |
| 7 | Pakcoy | 0.3558 | 35.58% |
| 8 | Selada | 0.1578 | 15.78% |

---

### 2. K1 asam — pH tanah rendah

| K1 | K2 | K3 | K4 | K5 | K6 | K7 |
|----|----|----|----|----|----|----|
| 5.6 | 7.0 | 27.5 | 72.5 | 9 | 1800 | 150 |

| # | Tanaman | vi | % |
|---|---------|----|---|
| 1 | Pisang | 0.8985 | 89.85% |
| 2 | Cabai | 0.7178 | 71.78% |
| 3 | Kangkung | 0.6393 | 63.93% |
| 4 | Pepaya | 0.4647 | 46.47% |
| 5 | Bayam | 0.3807 | 38.07% |
| 6 | Tomat | 0.3380 | 33.80% |
| 7 | Pakcoy | 0.2796 | 27.96% |
| 8 | Selada | 0.0763 | 7.63% |

---

### 3. K2 asam — pH air rendah

| K1 | K2 | K3 | K4 | K5 | K6 | K7 |
|----|----|----|----|----|----|----|
| 6.25 | 5.7 | 27.5 | 72.5 | 9 | 1800 | 150 |

| # | Tanaman | vi | % |
|---|---------|----|---|
| 1 | Pisang | 0.9178 | 91.78% |
| 2 | Kangkung | 0.8265 | 82.65% |
| 3 | Pepaya | 0.6966 | 69.66% |
| 4 | Cabai | 0.6731 | 67.31% |
| 5 | Bayam | 0.5335 | 53.35% |
| 6 | Tomat | 0.4851 | 48.51% |
| 7 | Pakcoy | 0.2471 | 24.71% |
| 8 | Selada | 0.1589 | 15.89% |

---

### 4. K3 dingin — suhu 22°C

| K1 | K2 | K3 | K4 | K5 | K6 | K7 |
|----|----|----|----|----|----|----|
| 6.25 | 7.0 | 22 | 72.5 | 9 | 1800 | 150 |

| # | Tanaman | vi | % |
|---|---------|----|---|
| 1 | Pisang | 0.6166 | 61.66% |
| 2 | Kangkung | 0.5850 | 58.50% |
| 3 | Tomat | 0.5457 | 54.57% |
| 4 | Pepaya | 0.5057 | 50.57% |
| 5 | Pakcoy | 0.4788 | 47.88% |
| 6 | Bayam | 0.4734 | 47.34% |
| 7 | Cabai | 0.4458 | 44.58% |
| 8 | Selada | 0.2039 | 20.39% |

---

### 5. K3 panas — suhu 32.5°C

| K1 | K2 | K3 | K4 | K5 | K6 | K7 |
|----|----|----|----|----|----|----|
| 6.25 | 7.0 | 32.5 | 72.5 | 9 | 1800 | 150 |

| # | Tanaman | vi | % |
|---|---------|----|---|
| 1 | Kangkung | 0.8700 | 87.00% |
| 2 | Pisang | 0.7640 | 76.40% |
| 3 | Pepaya | 0.5505 | 55.05% |
| 4 | Bayam | 0.3270 | 32.70% |
| 5 | Cabai | 0.3150 | 31.50% |
| 6 | Tomat | 0.2916 | 29.16% |
| 7 | Pakcoy | 0.2833 | 28.33% |
| 8 | Selada | 0.1234 | 12.34% |

---

### 6. K4 lembab — kelembapan 85.5%

| K1 | K2 | K3 | K4 | K5 | K6 | K7 |
|----|----|----|----|----|----|----|
| 6.25 | 7.0 | 27.5 | 85.5 | 9 | 1800 | 150 |

| # | Tanaman | vi | % |
|---|---------|----|---|
| 1 | Pisang | 0.8998 | 89.98% |
| 2 | Kangkung | 0.8266 | 82.66% |
| 3 | Pepaya | 0.6718 | 67.18% |
| 4 | Cabai | 0.6445 | 64.45% |
| 5 | Bayam | 0.5701 | 57.01% |
| 6 | Tomat | 0.4866 | 48.66% |
| 7 | Pakcoy | 0.4233 | 42.33% |
| 8 | Selada | 0.1191 | 11.91% |

---

### 7. K5 redup — cahaya 4.5 jam

| K1 | K2 | K3 | K4 | K5 | K6 | K7 |
|----|----|----|----|----|----|----|
| 6.25 | 7.0 | 27.5 | 72.5 | 4.5 | 1800 | 150 |

| # | Tanaman | vi | % |
|---|---------|----|---|
| 1 | Pisang | 0.8514 | 85.14% |
| 2 | Kangkung | 0.8052 | 80.52% |
| 3 | Bayam | 0.7400 | 74.00% |
| 4 | Pepaya | 0.6515 | 65.15% |
| 5 | Cabai | 0.6426 | 64.26% |
| 6 | Pakcoy | 0.3941 | 39.41% |
| 7 | Tomat | 0.3657 | 36.57% |
| 8 | Selada | 0.1756 | 17.56% |

---

### 8. K6 kering — curah hujan 800 mm

| K1 | K2 | K3 | K4 | K5 | K6 | K7 |
|----|----|----|----|----|----|----|
| 6.25 | 7.0 | 27.5 | 72.5 | 9 | 800 | 150 |

| # | Tanaman | vi | % |
|---|---------|----|---|
| 1 | Cabai | 0.7971 | 79.71% |
| 2 | Pisang | 0.6498 | 64.98% |
| 3 | Pepaya | 0.6066 | 60.66% |
| 4 | Kangkung | 0.5986 | 59.86% |
| 5 | Tomat | 0.5554 | 55.54% |
| 6 | Bayam | 0.5013 | 50.13% |
| 7 | Selada | 0.2969 | 29.69% |
| 8 | Pakcoy | 0.2887 | 28.87% |

---

## Cara menjalankan regression test

```bash
php artisan test --filter=TOPSISTest
```

## Perubahan pada v3

| Perubahan | Sebelum | Sesudah |
|---|---|---|
| Base skor | Dari DB (3/5/7/9) | 9.0 (selalu) |
| Dalam range | Tier diskrit (9/7/5/3) | Linear 9 → 5 |
| Di luar range | Tier diskrit (5/3/1) | Linear 5 → 1 |
