<div>Sou o index</div>

<?php 
foreach ($carrinhos as $carrinho): ?>
    <p><?= $carrinho['id_carrinho'] ?? '' ?></p>
    <p><?= $carrinho['id_cliente'] ?? '' ?></p>
    <p><?= $carrinho['data_pedido_carrinho'] ?? '' ?></p>
    <p><?= $carrinho['total_carrinho'] ?? '' ?></p>
    <p><?= $carrinho['status_carrinho'] ?? '' ?></p>
    <p><?= $carrinho['criado_em'] ?? '' ?></p>
    <p><?= $carrinho['atualizado_em'] ?? '' ?></p>
    <p><?= $carrinho['excluido_em'] ?? '' ?></p>
<?php endforeach; ?>