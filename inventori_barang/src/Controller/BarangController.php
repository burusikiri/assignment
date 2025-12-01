<?php
namespace src\Controller;

use src\Core\ArgParser;
use src\Repository\BarangRepository;
use src\View\ConsoleView;
use src\Model\Barang;

class BarangController {
    private BarangRepository $repo;
    private ConsoleView $view;

    public function __construct(BarangRepository $repo, ConsoleView $view) {
        $this->repo = $repo;
        $this->view = $view;
    }
}
?>