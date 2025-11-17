<div class="w3-container w3-margin-top">
    <h2>Lista de Usuários</h2>

    <!-- Botão para Criar Novo Usuário -->
    <p>
        <a href="usuario/criar" class="w3-button w3-blue w3-round-large">
            <i class="fa fa-plus"></i> Novo Usuário
        </a>
    </p>

    <table class="w3-table w3-striped w3-bordered w3-hoverable w3-white">
        <thead>
            <tr class="w3-light-blue">
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Tipo</th>
                <th>Criado Em</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $usuario = $data['usuario'] ?? []; 
            if (empty($usuario)): ?>
                <tr>
                    <td colspan="6">Nenhum usuário encontrado.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($usuario as $u): ?>
                    <tr>
                        <td><?= htmlspecialchars($u['id_usuarios']) ?></td>
                        <td><?= htmlspecialchars($u['nome_usuarios']) ?></td>
                        <td><?= htmlspecialchars($u['email_usuarios']) ?></td>
                        <td><?= htmlspecialchars($u['nivel_acesso']) ?></td>
                        <td><?= htmlspecialchars($u['criado_em']) ?></td>
                        <td>
                            <a href="/usuario/editar/<?= $u['id_usuario'] ?>" class="w3-button w3-tiny w3-yellow w3-margin-right">Editar</a>
                            <a href="/usuario/excluir/<?= $u['id_usuario'] ?>" class="w3-button w3-tiny w3-red">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <?php if (!empty($usuario) && !empty($paginacao)): ?>
    <div class="cao-controls" style="display:flex; justify-content:space-between; align-items:center; margin-top:20px;">
        <div class="page-selector" style="display:flex; align-items:center;">
            <div class="page-nav">
                <?php if ($paginacao['pagina_atual'] > 1): ?>
                    <a href="/backend/usuario/listar/<?= $paginacao['pagina_atual'] - 1 ?>">Anterior</a>
                <?php endif; ?>
                <span style="margin:0 10px;">Página <?= $paginacao['pagina_atual'] ?> de <?= $paginacao['ultima_pagina'] ?></span>
                <?php if ($paginacao['pagina_atual'] < $paginacao['ultima_pagina']): ?>
                    <a href="/backend/usuario/listar/<?= $paginacao['pagina_atual'] + 1 ?>">Próximo</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
