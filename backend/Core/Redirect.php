<?php
namespace App\Koketsu\Core;
use App\Koketsu\Core\Flash;

class Redirect{
    public static function redirecionarPara($url){
        // Use URL as provided when absolute or already rooted; otherwise ensure it starts with '/'
        if (preg_match('#^https?://#i', $url)) {
            header("Location: " . $url);
        } elseif (substr($url, 0, 1) === '/') {
            header("Location: " . $url);
        } else {
            header("Location: /" . $url);
        }
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