<?php

namespace Inventory\View;

class ConsoleView
{
    public function renderList($barangs)
    {
        if (empty($barangs)) {
            echo "Belum ada data barang.\n";
            return;
        }

        echo "DAFTAR INVENTARIS BARANG\n";
        echo "------------------------------------------------------------\n";
        // Format tabel menggunakan printf
        // %-5s artinya string rata kiri lebar 5 char
        printf("| %-5s | %-20s | %-12s | %-6s |\n", "ID", "Nama Barang", "Harga (Rp)", "Stok");
        echo "------------------------------------------------------------\n";

        foreach ($barangs as $barang) {
            printf(
                "| %-5d | %-20s | %-12s | %-6d |\n",
                $barang->getId(),
                substr($barang->getNama(), 0, 20), // Potong jika terlalu panjang
                number_format($barang->getHarga(), 0, ',', '.'),
                $barang->getStock()
            );
        }
        echo "------------------------------------------------------------\n";
    }

    public function renderSuccess($message)
    {
        // Warna Hijau untuk sukses (ANSI Escape Code)
        echo "\033[32m[SUKSES]\033[0m " . $message . "\n";
    }

    public function renderError($message)
    {
        // Warna Merah untuk error
        echo "\033[31m[ERROR]\033[0m " . $message . "\n";
    }
}
?>