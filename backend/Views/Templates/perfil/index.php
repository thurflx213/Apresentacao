<div>Sou o index</div>
<?php foreach ($perfis as $perfil): ?>
    <p><?= $perfil['id_perfil'] ?></p>
    <p><?= $perfil['telefone_perfil'] ?></p>
    <p><?= $perfil['endereco_perfil'] ?></p>
    <p><?= $perfil['data_cadastro'] ?></p>
    <hr>
<?php endforeach; ?>
