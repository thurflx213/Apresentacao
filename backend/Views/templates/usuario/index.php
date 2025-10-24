<div class="w3-container w3-margin-top">
    <h2>Lista de Usuários</h2>

    <!-- Botão para Criar Novo Usuário -->
    <p>
        <a href="/usuario/criar" class="w3-button w3-blue w3-round-large">
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
                    <td colspan="6" class="w3-center">Nenhum usuário ativo encontrado.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($usuario as $usuario): ?>
                    <tr>
                        <td><?= htmlspecialchars($usuario['id_usuario']) ?></td>
                        <td><?= htmlspecialchars($usuario['nome_usuario']) ?></td>
                        <td><?= htmlspecialchars($usuario['email_usuario']) ?></td>
                        <td><?= htmlspecialchars($usuario['tipo_usuario']) ?></td>
                        <td><?= htmlspecialchars($usuario['criado_em']) ?></td>
                        <td>
                            <!-- Links de Ação -->
                            <a href="/usuario/editar/<?= $usuario['id_usuario'] ?>" 
                               class="w3-button w3-tiny w3-yellow w3-margin-right">Editar</a>
                            <a href="/usuario/excluir/<?= $usuario['id_usuario'] ?>" 
                               class="w3-button w3-tiny w3-red">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    
    <!-- Navegação de Paginação -->
    <?php 
    $paginaAtual = $data['paginaAtual'] ?? 1;
    $totalPaginas = $data['totalPaginas'] ?? 1;
    
    if ($totalPaginas > 1): ?>
        <div class="w3-bar w3-padding w3-center">
            <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                <a 
                    href="/usuario/listar/<?= $i ?>" 
                    class="w3-bar-item w3-button w3-border <?= $i == $paginaAtual ? 'w3-blue' : '' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>
        </div>
    <?php endif; ?>
</div>