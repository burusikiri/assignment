<?php

namespace Inventory\Repository;

use Inventory\Model\Barang;

class BarangRepository
{
    private $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
        // Pastikan file json ada, jika tidak buat array kosong
        if (!file_exists($this->filePath)) {
            file_put_contents($this->filePath, json_encode([]));
        }
    }

    // Mengambil semua data dan mengembalikannya sebagai array of objects Barang
    public function findAll()
    {
        $jsonContent = file_get_contents($this->filePath);
        $dataArray = json_decode($jsonContent, true) ?? [];

        $result = [];
        foreach ($dataArray as $item) {
            $result[] = Barang::fromArray($item);
        }
        return $result;
    }

    // Menyimpan data baru
    public function save(Barang $barang)
    {
        $barangs = $this->findAll();
        
        // Konversi semua object ke array dulu
        $dataToSave = array_map(function($b) {
            return $b->toArray();
        }, $barangs);

        // Tambah data baru
        $dataToSave[] = $barang->toArray();

        // Tulis ulang ke JSON
        file_put_contents($this->filePath, json_encode($dataToSave, JSON_PRETTY_PRINT));
    }

    // Menghapus data berdasarkan ID
    public function delete($id)
    {
        $barangs = $this->findAll();
        $newData = [];
        $found = false;

        foreach ($barangs as $barang) {
            if ($barang->getId() != $id) {
                $newData[] = $barang->toArray();
            } else {
                $found = true;
            }
        }

        if ($found) {
            file_put_contents($this->filePath, json_encode($newData, JSON_PRETTY_PRINT));
        }

        return $found;
    }

    // Generate ID otomatis (Auto Increment sederhana)
    public function generateId()
    {
        $barangs = $this->findAll();
        if (empty($barangs)) {
            return 1;
        }
        // Ambil ID terakhir + 1
        $lastItem = end($barangs);
        return $lastItem->getId() + 1;
    }
}

?>