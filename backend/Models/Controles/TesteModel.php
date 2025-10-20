<?php
require_once __DIR__ . '/../Models/Pedidos.php';
require_once __DIR__ . '/../Database/Database.php';

$pedido = new Pedidos($db);
$pedido = $pedido->buscarPedidosPorCliente('2');
var_dump($pedido);