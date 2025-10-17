<div>Sou o index</div>

<?php 
foreach ($estoque_movimentacao as $movimentacao): ?>
    <p><?= $movimentacao['id_estoque_movimentacao'] ?></p>
    <p><?= $movimentacao['id_produto'] ?></p>
    <p><?= $movimentacao['tipo_estoque_movimentacao'] ?></p>
    <p><?= $movimentacao['quantidade_estoque_movimentacao'] ?></p>
    <p><?= $movimentacao['data_movimentacao_estoque_movimentacao'] ?></p>
    <p><?= $movimentacao['descricao_estoque_movimentacao'] ?></p>
    <p><?= $movimentacao['criado_em'] ?></p>
    <p><?= $movimentacao['atualizado_em'] ?></p>
    <p><?= $movimentacao['excluido_em'] ?></p>
<?php endforeach; ?>