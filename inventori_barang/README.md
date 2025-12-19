Latihan kelas PBO pertemuan sebelas tanggal 1 Desember 2025.

# Aplikasi Inventaris Barang CLI

Aplikasi manajemen stok barang sederhana berbasis **Command Line Interface (CLI)** menggunakan bahasa pemrograman **PHP Native**.

Aplikasi ini dibangun menggunakan pola arsitektur **MVC (Model-View-Controller)** dan **Repository Pattern**, serta menyimpan data menggunakan file **JSON** (tanpa database SQL).

## Fitur

1.  **Lihat Data (List):** Menampilkan daftar barang dalam format tabel.
2.  **Tambah Data (Add):** Menambahkan barang baru dengan nama, harga, dan stok.
3.  **Hapus Data (Delete):** Menghapus barang berdasarkan ID.
4.  **Penyimpanan Persisten:** Data tersimpan otomatis di `data/barang.json`.

## Persyaratan

* PHP versi 7.4 atau terbaru.
* Terminal / Command Prompt / PowerShell.

## Cara Instalasi & Persiapan

1.  Pastikan struktur folder Anda sudah sesuai seperti di bawah ini:
    ```text
    brg-inventory/
    ├─ bin/
    │  └─ console         <-- Entry point aplikasi
    ├─ data/
    │  └─ barang.json     <-- File ini akan dibuat otomatis oleh aplikasi
    ├─ src/
    │  ├─ Controller/
    │  ├─ Model/
    │  ├─ Repository/
    │  └─ View/
    └─ README.md
    ```

2.  Buka terminal dan arahkan ke folder proyek `brg-inventory`.

3.  Pastikan folder `data/` sudah ada. Jika belum, buat folder tersebut secara manual.

## Panduan Penggunaan

Jalankan perintah berikut melalui terminal di dalam folder proyek.

### 1. Menambah Barang
Gunakan perintah `barang:add` diikuti dengan flag `--nama`, `--harga`, dan `--stock`.

```bash
php bin/console barang:add --nama "Buku Tulis" --harga 4500 --stock 50