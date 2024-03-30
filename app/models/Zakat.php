<?php

namespace App\Model;

class Zakat
{
    private String $id;
    private string $nama;
    private int $jumlah;
    private string $alamat;
    private string $rincian;
    private String $keterangan;
    private String $code;

    public function __construct($id, $nama, $jumlah, $alamat, $rincian, $keterangan, $code)
    {
        $this->id = $id;
        $this->nama = $nama;
        $this->jumlah = $jumlah;
        $this->alamat = $alamat;
        $this->rincian = $rincian;
        $this->keterangan = $keterangan;
        $this->code = $code;
    }



    public function getId(): String
    {
        return $this->id;
    }
    public function setId(String $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getNama(): string
    {
        return $this->nama;
    }
    public function setNama(string $nama): self
    {
        $this->nama = $nama;
        return $this;
    }

    public function getJumlah(): int
    {
        return $this->jumlah;
    }
    public function setJumlah(int $jumlah): self
    {
        $this->jumlah = $jumlah;
        return $this;
    }

    public function getAlamat(): string
    {
        return $this->alamat;
    }
    public function setAlamat(string $alamat): self
    {
        $this->alamat = $alamat;
        return $this;
    }

    public function getRincian(): string
    {
        return $this->rincian;
    }
    public function setRincian(string $rincian): self
    {
        $this->rincian = $rincian;
        return $this;
    }

    public function getKeterangan(): String
    {
        return $this->keterangan;
    }
    public function setKeterangan(String $keterangan): self
    {
        $this->keterangan = $keterangan;
        return $this;
    }

    public function toArray(){
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'jumlah' => $this->jumlah,
            'alamat' => $this->alamat,
            'rincian' => $this->rincian,
            'keterangan' => $this->keterangan,
            'code' => $this->code,
        ];
    }

    public function getCode(): String { return $this->code; }
    public function setCode(String $code): self { $this->code = $code; return $this; }
}
