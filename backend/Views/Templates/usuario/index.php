<div>Sou o index</div>
<?php foreach ($usuarios as $usuario): ?>
    <p><?= $usuario['id_usuarios'] ?></p>
    <p><?= $usuario['nome_usuarios'] ?></p>
    <p><?= $usuario['email_usuarios'] ?></p>
    <p><?= $usuario['nivel_acesso'] ?></p>
<?php endforeach; ?>
 