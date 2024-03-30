<?php
namespace App\Utils;

class Uuid
{
    static function toUUID($id)
    {
        // Hash ID dengan menggunakan SHA-256 untuk meningkatkan keunikan
        $hash = hash('sha256', $id);

        // Mengambil sebagian dari hash untuk membuat format UUID
        $uuid = substr($hash, 0, 8) . '-' .
                substr($hash, 8, 4) . '-' .
                substr($hash, 12, 4) . '-' .
                substr($hash, 16, 4) . '-' .
                substr($hash, 20, 12);

        return $uuid;
    }

    static function toId($uuid)
    {
        // Fungsi ini menjadi lebih kompleks karena hash tidak bisa dengan mudah 'dibalik'
        // Anda mungkin perlu mempertimbangkan pendekatan yang berbeda jika Anda perlu
        // mengonversi kembali ke ID asli, tergantung pada kasus penggunaan Anda.
        // Contoh sederhana ini hanya memberikan struktur fungsi tanpa implementasi nyata.
        throw new \Exception("Operasi toId tidak didukung untuk UUID yang di-hash.");
    }
}
