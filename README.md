# 🏥 SISTEM PAKAR DIAGNOSA PENYAKIT PENCERNAAN
## Metode Fuzzy Logic Sugeno

![PHP Version](https://img.shields.io/badge/PHP-7.4+-blue)
![Yii2](https://img.shields.io/badge/Yii2-2.0.54-green)
![MySQL](https://img.shields.io/badge/MySQL-5.7+-orange)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.1-purple)
![License](https://img.shields.io/badge/License-MIT-red)

> Sistem pakar berbasis web untuk mendiagnosa penyakit pencernaan manusia menggunakan metode **Fuzzy Logic Sugeno**. Aplikasi ini membantu pasien dan tenaga medis dalam mendiagnosa awal penyakit pencernaan berdasarkan gejala yang dialami dengan tingkat akurasi yang tinggi.

---

## 📋 DAFTAR ISI

- [Tentang Proyek](#-tentang-proyek)
- [Fitur](#-fitur)
- [Teknologi](#-teknologi)
- [Persyaratan Sistem](#-persyaratan-sistem)
- [Instalasi](#-instalasi)
- [Konfigurasi Database](#-konfigurasi-database)
- [Struktur Database](#-struktur-database)
- [Menjalankan Aplikasi](#-menjalankan-aplikasi)
- [Struktur Proyek](#-struktur-proyek)
- [Panduan Penggunaan](#-panduan-penggunaan)
- [Metode Fuzzy Logic](#-metode-fuzzy-logic)
- [Daftar Penyakit](#-daftar-penyakit)
- [Daftar Gejala](#-daftar-gejala)
- [Screenshots](#-screenshots)
- [Troubleshooting](#-troubleshooting)
- [Pengembang](#-pengembang)
- [Lisensi](#-lisensi)
- [Disclaimer](#-disclaimer)

---

## 🎯 TENTANG PROYEK

Sistem pencernaan pada manusia merupakan salah satu organ vital yang memerlukan perhatian khusus. Penyakit pencernaan menyumbangkan sekitar **30 persen angka kematian** di dunia. Oleh karena itu, diperlukan sistem yang dapat membantu diagnosis awal penyakit pencernaan.

Proyek ini mengimplementasikan **Sistem Pakar** dengan metode **Fuzzy Logic Sugeno** untuk:
- Mendiagnosa penyakit pencernaan berdasarkan gejala
- Menghitung tingkat keparahan penyakit
- Memberikan rekomendasi penanganan awal
- Menyimpan riwayat diagnosis pasien

### Referensi Penelitian
Kurniawan, H., Gustientiedina, Desnelita, Y., & Gusrianty. (2022). Implementasi Metode Fuzzy Logic Untuk Aplikasi Diagnosa Penyakit Pencernaan Manusia. *Indonesian Journal of Computer Science*, 11(1), 209-215.

---

## ✨ FITUR

### Core Features
| Fitur | Deskripsi |
|-------|------------|
| 🩺 **Diagnosa Penyakit** | Mendiagnosa 20+ penyakit pencernaan berdasarkan gejala |
| 📊 **Fuzzy Logic** | Perhitungan tingkat keparahan dengan metode Sugeno |
| 🏷️ **4 Kategori Keparahan** | Ringan, Sedang, Parah, Sangat Parah |
| 📝 **Riwayat Diagnosis** | Menyimpan dan melihat riwayat diagnosis pasien |
| 🖨️ **Cetak Hasil** | Mencetak hasil diagnosis |

### User Features
| Fitur | Deskripsi |
|-------|------------|
| 👤 **Input Pasien** | Form input nama dan usia pasien |
| ✅ **Pilih Gejala** | 53 gejala yang dikelompokkan per kategori |
| 🎯 **Hasil Diagnosis** | Menampilkan penyakit, persentase, dan kategori |
| 📋 **Detail Penyakit** | Informasi lengkap tentang penyakit |
| 🔄 **Reset Diagnosis** | Mulai diagnosis baru |

### Admin Features
| Fitur | Deskripsi |
|-------|------------|
| 📜 **Lihat Riwayat** | Semua riwayat diagnosis pasien |
| 🗑️ **Hapus Riwayat** | Hapus semua riwayat diagnosis |
| 🔍 **Detail Pasien** | Lihat detail gejala yang dipilih |

---

## 🛠 TEKNOLOGI

### Backend
| Teknologi | Versi | Fungsi |
|-----------|-------|--------|
| **PHP** | >= 7.4 | Bahasa pemrograman |
| **Yii2 Framework** | 2.0.54 | Framework PHP |
| **MySQL** | >= 5.7 | Database |
| **Composer** | Latest | Dependency manager |

### Frontend
| Teknologi | Versi | Fungsi |
|-----------|-------|--------|
| **Bootstrap** | 5.1.3 | CSS Framework |
| **jQuery** | 3.6.0 | JavaScript library |
| **SweetAlert2** | 11.x | Alert & Modal |
| **Font Awesome** | 6.0 | Icons |

---

## 💻 PERSYARATAN SISTEM

### Minimum Requirements
```yaml
OS: Windows 10 / macOS 10.14+ / Linux (Ubuntu 18.04+)
RAM: 512 MB (1 GB recommended)
CPU: 1.0 GHz (2.0 GHz recommended)
Storage: 100 MB (500 MB recommended)