<?php
namespace App\Koketsu\Core;
use App\Koketsu\Core\Flash;

class Redirect{
    public static function redirecionarPara($url){
        var_dump($url);exit;
        header("Location: /backend".$url);
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