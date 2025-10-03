<div>Sou o index de tamanhos</div>
<?php foreach ($Tamanhos as $tamanho): ?>
    <p><?= $tamanho['id_tamanho'] ?></p>
    <p><?= $tamanho['id_produto'] ?></p>
    <p><?= $tamanho['tamanho_tamanhos'] ?></p>
    <p><?= $tamanho['quantidade_tamanho'] ?></p>
    <hr>
<?php endforeach; ?>
