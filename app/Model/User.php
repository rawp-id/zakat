<?php

namespace App\Model;

class User
{
    protected int $id;
    protected String $nama;
    protected String $email;
    protected String $password;
    protected String $verifikasi;
    protected String $role;
    protected String $kode_ms;

    public function __construct($id, $nama, $email, $password, $verifikasi, $role, $kode_ms)
    {
        $this->id = $id;
        $this->nama = $nama;
        $this->email = $email;
        $this->password = $password;
        $this->verifikasi = $verifikasi;
        $this->role = $role;
        $this->kode_ms = $kode_ms;
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getNama(): String
    {
        return $this->nama;
    }
    public function setNama(String $nama): self
    {
        $this->nama = $nama;
        return $this;
    }

    public function getEmail(): String
    {
        return $this->email;
    }
    public function setEmail(String $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): String
    {
        return $this->password;
    }
    public function setPassword(String $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getVerifikasi(): String
    {
        return $this->verifikasi;
    }
    public function setVerifikasi(String $verifikasi): self
    {
        $this->verifikasi = $verifikasi;
        return $this;
    }

    public function getRole(): String
    {
        return $this->role;
    }
    public function setRole(String $role): self
    {
        $this->role = $role;
        return $this;
    }

    public function getKodeMs(): String
    {
        return $this->kode_ms;
    }
    public function setKodeMs(String $kode_ms): self
    {
        $this->kode_ms = $kode_ms;
        return $this;
    }

    public function toArray(){
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'email' => $this->email,
            'password' => $this->password,
            'verifikasi' => $this->verifikasi,
            'role' => $this->role,
            'kode_ms' => $this->kode_ms,
        ];
    }
}
