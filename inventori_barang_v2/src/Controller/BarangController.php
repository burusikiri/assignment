<?php

namespace Inventory\Controller;

use Inventory\Model\Barang;
use Inventory\Repository\BarangRepository;
use Inventory\View\ConsoleView;

class BarangController
{
    private $repository;
    private $view;

    public function __construct()
    {
        // Path disesuaikan dengan struktur folder: root/data/barang.json
        $dbPath = __DIR__ . '/../../data/barang.json';
        $this->repository = new BarangRepository($dbPath);
        $this->view = new ConsoleView();
    }

    // Command: barang:list
    public function list()
    {
        $barangs = $this->repository->findAll();
        $this->view->renderList($barangs);
    }

    // Command: barang:add --nama "X" --harga 100 --stock 10
    public function add($args)
    {
        // Validasi sederhana
        if (!isset($args['nama']) || !isset($args['harga']) || !isset($args['stock'])) {
            $this->view->renderError("Parameter tidak lengkap. Gunakan: --nama [nama] --harga [harga] --stock [stock]");
            return;
        }

        $id = $this->repository->generateId();
        $barang = new Barang(
            $id,
            $args['nama'],
            $args['harga'],
            $args['stock']
        );

        $this->repository->save($barang);
        $this->view->renderSuccess("Data berhasil ditambahkan! (ID: $id)");
    }

    // Command: barang:delete --id 1
    public function delete($args)
    {
        if (!isset($args['id'])) {
            $this->view->renderError("ID harus diisi. Gunakan: --id [angka]");
            return;
        }

        $success = $this->repository->delete($args['id']);

        if ($success) {
            $this->view->renderSuccess("Data dengan ID {$args['id']} berhasil dihapus.");
        } else {
            $this->view->renderError("Data dengan ID {$args['id']} tidak ditemukan.");
        }
    }
}

?>