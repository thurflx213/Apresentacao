<?php
namespace App\Koketsu\Core;
use App\Koketsu\Core\Flash;

class Redirect{
    public static function redirecionarPara($url){
        // Ensure internal URLs are absolute from root
        if (strpos($url, 'http') !== 0 && strpos($url, '/') !== 0) {
            $url = '/' . $url;
        }
        header("Location: " . $url);
        exit;
    }

    public static function redirecionarComMensagem($url, $type, $message){
        
        Flash::set($type, $message);
        self::redirecionarPara($url);

    }
    public static function voltarPaginaAnteriorComMensagem($type, $message){
        $url = $_SERVER['HTTP_REFERER'] ?? '/';
        self::redirecionarComMensagem($url, $type, $message);
    }
}