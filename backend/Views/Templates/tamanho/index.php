<div>Sou o index de tamanhos</div>
<?php foreach ($tamanhos as $tamanho): ?>
    <p><?= $tamanho['id_tamanhos'] ?></p>
    <p><?= $tamanho['id_produto'] ?></p>
    <p><?= $tamanho['tamanho_tamanhos'] ?></p>
    <p><?= $tamanho['quantidade_tamanhos'] ?></p>
    <hr>
<?php endforeach; ?>
