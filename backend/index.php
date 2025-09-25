<?php
namespace App\Koketsu;
require_once __DIR__ . '/../vendor/autoload.php';


use App\Koketsu\Controles\TamanhoController;

// var_dump($_SERVER ["REQUEST_URI"]);
// echo"\n\n\n\n";
// var_dump($_REQUEST ["REQUEST_METHOD"]);
// exit;
if($_SERVER["REQUEST_URI"] == "/backend/buscarTamanhos" && $_SERVER ["REQUEST_METHOD"] == "GET")
{
    $controles = new TamanhoController;
    $resultado = $controles->index();
    var_dump($resultado);
}else
{
    echo 'rota não encontrada';
}