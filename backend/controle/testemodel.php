<?php
require_once __DIR__.'/../model/estoque_movimentacao.php';
require_once __DIR__.'/../Database/Database.php';

$estoqueMovimentacao = new EstoqueMovimentacao($db);

$resultado = $estoqueMovimentacao->atualizarMovimentacao(1);
var_dump($resultado);




