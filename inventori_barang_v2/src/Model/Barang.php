<?php

namespace Inventory\Model;

class Barang
{
    private $id;
    private $nama;
    private $harga;
    private $stock;

    public function __construct($id, $nama, $harga, $stock)
    {
        $this->id = $id;
        $this->nama = $nama;
        $this->harga = $harga;
        $this->stock = $stock;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getNama() { return $this->nama; }
    public function getHarga() { return $this->harga; }
    public function getStock() { return $this->stock; }

    // Konversi object ke array (untuk disimpan ke JSON)
    public function toArray()
    {
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'harga' => $this->harga,
            'stock' => $this->stock
        ];
    }

    // Helper static untuk membuat object dari array (saat load dari JSON)
    public static function fromArray($data)
    {
        return new self(
            $data['id'] ?? null,
            $data['nama'],
            $data['harga'],
            $data['stock']
        );
    }
}

?>