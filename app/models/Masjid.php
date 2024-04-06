<?php

namespace App\Models;

class Masjid
{
    protected String $id;
    protected string $nama;
    protected String $code;

    public function __construct($id, $nama, $code)
    {
        $this->id = $id;
        $this->nama = $nama;
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

    public function toArray(){
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'kode_ms' => $this->code,
        ];
    }

    public function getCode(): String { return $this->code; }
    public function setCode(String $code): self { $this->code = $code; return $this; }
}
