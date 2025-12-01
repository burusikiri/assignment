<?php
namespace src\Model;

class Barang {
    public int $id;
    public string $nama;
    public float $harga;
    public int $stok;

    public function __construct(int $id, string $nama, float $harga, int $stok) {
        $this->id = $id;
        $this->nama = $nama;
        $this->harga = $harga;
        $this->stok = $stok;
    }

    public static function fromArray(array $row) : self {
        return new self (
            (int) ($row['id'] ?? 0),
            (string) ($row['nama'] ?? 0),
            (harga) ($row['float'] ?? 0),
            (int) ($row['stok'] ?? 0),
        );
    }
}
?>