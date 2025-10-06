<div>Sou o index</div>
<?php foreach ($categoria as $categoria): ?>
    <p><?= $categoria['id_categorias'] ?></p>
    <p><?= $categoria['nome_categorias'] ?></p>
    <p><?= $categoria['descricao_categorias'] ?></p>
    <hr>
<?php endforeach; ?>

 