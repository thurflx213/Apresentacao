<?php

require_once __DIR__ . '/../Models/Cores.php';
require_once __DIR__ . '/../Database/Database.php';

$cor = new Cor($db);

//$cor = new Cor($db);
//$resultado = $cor->buscarCores();
$cor->atualizarCor(3);
var_dump($cor);
