<?php

class EMoney
{
    private $id;
    private $saldo;
    private $log = [];

    public function __construct($id, $saldoAwal = 0)
    {
        $this->id = $id;
        $this->saldo = $saldoAwal;
        $this->tulisLog("Akun dibuat dengan saldo awal {$saldoAwal}");
    }

    private function tulisLog($pesan)
    {
        $waktu = date("Y-m-d H:i:s");
        $this->log[] = "$pesan pada $waktu";
    }

    // 1. Top up
    public function topUp($jumlah)
    {
        if ($jumlah <= 0) {
            $this->tulisLog("ERROR: Top up gagal. Jumlah tidak valid");
            return false;
        }

        $this->saldo += $jumlah;
        $this->tulisLog("Top up sebesar $jumlah");
        return true;
    }

    // 2. Pay off
    public function payOff($jumlah, $deskripsi)
    {
        if ($jumlah <= 0) {
            $this->tulisLog("ERROR: Pembayaran '$deskripsi' gagal. Jumlah tidak valid");
            return false;
        }

        if ($this->saldo < $jumlah) {
            $this->tulisLog("ERROR: Pembayaran '$deskripsi' gagal. Saldo tidak mencukupi");
            return false;
        }

        $this->saldo -= $jumlah;
        $this->tulisLog("Pembayaran '$deskripsi' sebesar $jumlah");
        return true;
    }

    // 3. Transfer
    public function transfer(EMoney $tujuan, $jumlah)
    {
        if ($jumlah <= 0) {
            $this->tulisLog("ERROR: Transfer gagal. Jumlah tidak valid");
            return false;
        }

        if ($this->saldo < $jumlah) {
            $this->tulisLog("ERROR: Transfer ke akun {$tujuan->id} sebesar $jumlah gagal. Saldo tidak cukup");
            return false;
        }

        // Pengirim
        $this->saldo -= $jumlah;
        $this->tulisLog("Transfer sebesar $jumlah ke akun {$tujuan->id}");

        // Penerima
        $tujuan->saldo += $jumlah;
        $tujuan->tulisLog("Menerima transfer sebesar $jumlah dari akun {$this->id}");

        return true;
    }

    // Access method
    public function getSaldo()
    {
        return $this->saldo;
    }

    public function getLog()
    {
        return $this->log;
    }
}

?>