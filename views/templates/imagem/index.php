<?php
foreach ($imagens as $imagem): ?>
    <p><?= $imagem['id_imagem'] ?></p>
    <p><?= $imagem['id_produto'] ?></p>
    <p><?= $imagem['url_imagem'] ?></p>
    <p><?= $imagem['criado_em'] ?></p>
    <p><?= $imagem['atualizado_em'] ?></p>
    <p><?= $imagem['excluido_em'] ?></p>
<?php endforeach; ?>