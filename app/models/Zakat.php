<?php

namespace App\Models;

class Zakat
{
    protected String $id;
    protected string $nama;
    protected int $jumlah;
    protected string $alamat;
    protected string $rincian;
    protected String $keterangan;
    protected String $code;
    protected int $status;
    protected String $tanggal;

    public function __construct($id, $nama, $jumlah, $alamat, $rincian, $keterangan, $code, $status, $tanggal)
    {
        $this->id = $id;
        $this->nama = $nama;
        $this->jumlah = $jumlah;
        $this->alamat = $alamat;
        $this->rincian = $rincian;
        $this->keterangan = $keterangan;
        $this->code = $code;
        $this->status = $status;
        $this->tanggal = $tanggal;
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
            'status' => $this->status,
            'tanggal' => $this->tanggal,
        ];
    }

    public function getCode(): String { return $this->code; }
    public function setCode(String $code): self { $this->code = $code; return $this; }

    public function getStatus(): int { return $this->status; }
    public function setStatus(int $status): self { $this->status = $status; return $this; }

    public function getTanggal(): String { return $this->tanggal; }
    public function setTanggal(String $tanggal): self { $this->tanggal = $tanggal; return $this; }
}
