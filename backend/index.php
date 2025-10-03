<?php
namespace App\Koketsu;
require_once __DIR__ . '/../vendor/autoload.php';
  if(!isset($_SESSION)){
            session_start();
        }
use App\Koketsu\Rotas\Rotas;

$rotas = Rotas::get();

$metodohttp = $_SERVER ["REQUEST_METHOD"];
$rota = $_SERVER ["REQUEST_URI"];

if(array_key_exists($rota, $rotas[$metodohttp]) == false){
    http_response_code(404);
    echo "Pagina não encontrada";
    exit;
}

$partes = explode("@", $rotas [$metodohttp] [$rota]);
$nomeController = $partes[0];
$metodoController = $partes[1];
$nomeCompletoController = "App\\Koketsu\\Controles\\". $nomeController;
if(!class_exists($nomeCompletoController )){
    http_response_code(500);
    echo "O controlador não encontrado";
    exit;
}
$controller = new $nomeCompletoController();
$controller ->$metodoController();


