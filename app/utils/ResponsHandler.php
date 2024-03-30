<?php
namespace App\Utils;
class ResponseHandler {
    public static function success($data) {
        return json_encode([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public static function error($message) {
        return json_encode([
            'status' => 'error',
            'message' => $message
        ]);
    }
}
