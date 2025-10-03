<div>Sou o index</div>
<?php foreach ($cores as $cor): ?>
    <p><?= $cor['id_cores'] ?></p>
    <p><?= $cor['id_produto'] ?></p>
    <p><?= $cor['cor_cores'] ?></p>
    <p><?= $cor['quantidade_cores'] ?></p>
    <hr>
<?php endforeach; ?>
