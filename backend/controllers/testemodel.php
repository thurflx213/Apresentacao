<?php
require_once __DIR__.'/../model/imagem.php';
require_once __DIR__.'/../Database/Database.php';

$imagem = new Imagem($db);

$resultado = $imagem->inserirImagem(1);
var_dump($resultado);




