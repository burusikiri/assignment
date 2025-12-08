<?php

require_once 'EMoney.php';

date_default_timezone_set("Asia/Jakarta");

// Membuat 3 akun e-Money
$A = new EMoney("A");
$B = new EMoney("B");
$C = new EMoney("C");

// Skenario
$A->topUp(100000);                        // Akun A top up 100k
$B->topUp(50000);                         // Akun B top up 50k
$A->transfer($C, 30000);                  // A transfer ke C
$B->payOff(20000, "Belanja Minimarket");  // B pembayaran
$C->payOff(100000, "Belanja Gagal");      // C coba bayar 100k (gagal)

function tampilkanAkun($akun, $nama)
{
    echo "=== Akun $nama ===\n";
    echo "Saldo: " . $akun->getSaldo() . "\n";
    echo "Log:\n";
    foreach ($akun->getLog() as $l) {
        echo " - " . $l . "\n";
    }
    echo "\n";
}

tampilkanAkun($A, "A");
tampilkanAkun($B, "B");
tampilkanAkun($C, "C");

?>