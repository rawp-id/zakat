<?php
namespace App\Utils;
class Response {
    public static function success($data) {
        return json_encode([
            'status' => true,
            'data' => $data
        ]);
    }

    public static function error($message) {
        return json_encode([
            'status' => false,
            'message' => $message
        ]);
    }

    public static function msg($status,$message) {
        return json_encode([
            'status' => $status,
            'message' => $message
        ]);
    }
}
