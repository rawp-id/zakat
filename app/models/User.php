<?php

namespace App\Models;

class User
{
    protected String $id;
    protected String $nama;
    protected String $email;
    protected String $password;
    protected String $verifikasi;
    protected String $role;
    protected String $kode_ms;
    protected String $google_id;
    protected String $kode_verif;

    public function __construct($id, $nama, $email, $password, $verifikasi, $role, $kode_ms, $google_id, $kode_verif)
    {
        $this->id = $id;
        $this->nama = $nama;
        $this->email = $email;
        $this->password = $password;
        $this->verifikasi = $verifikasi;
        $this->role = $role;
        $this->kode_ms = $kode_ms;
        $this->google_id = $google_id;
        $this->kode_verif = $kode_verif;
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

    public function getGoogleId(): String
    {
        return $this->google_id;
    }
    public function setGoogleId(String $google_id): self
    {
        $this->google_id = $google_id;
        return $this;
    }

    public function getKodeVerif(): String
    {
        return $this->kode_verif;
    }
    public function setKodeVerif(String $kode_verif): self
    {
        $this->kode_verif = $kode_verif;
        return $this;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'google_id' => $this->google_id,
            'nama' => $this->nama,
            'email' => $this->email,
            'password' => $this->password,
            'verifikasi' => $this->verifikasi,
            'kode_verif' => $this->kode_verif,
            'role' => $this->role,
            'kode_ms' => $this->kode_ms,
        ];
    }
}
