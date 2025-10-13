<div>Sou o index</div>

<?php foreach ($produtos as $produtos): ?>
    <p><?= $produtos['id_produto'] ?></p>
    <p><?= $produtos['nome_produtos'] ?></p>
    <p><?= $produtos['descricao_produtos'] ?></p>
    <p><?= $produtos['preco_produtos'] ?></p>
    <p><?= $produtos['estoque_produtos'] ?></p>
    <p><?= $produtos['imagem_produtos'] ?></p>
    <p><?= $produtos['id_categoria'] ?></p>
    <p><?= $produtos['criado_em'] ?></p>
    <p><?= $produtos['atualizado_em'] ?></p>
    <p><?= $produtos['excluido_em'] ?></p>
<?php endforeach; ?>