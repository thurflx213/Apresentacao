<?php
namespace App\Koketsu\Core;
use App\Koketsu\Core\Flash;

class Redirect {
   public static function redirectPara($url) {
      header("Location: /backend/" .$url);
      exit;
   }
    public static function redirecionarComMensagem($url, $type, $message) {
      Flash::set($type, $message);
      self::redirectPara($url);
   }
   public static function voltarPaginaAnteriorComMensagem($type, $message) {
      $url = $_SERVER['HTTP_REFERER'] ?? '/';
      self::redirecionarComMensagem($url, $type, $message);
   }
}