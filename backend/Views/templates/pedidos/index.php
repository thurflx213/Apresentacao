<header class="w3-container" style="padding-top:5px">
    <div class="w3-container">
        <h3><i class="fa fa-list"></i> Listar Pedidos</h3>
    </div>

    <div class="w3-panel w3-card-4 w3-round-large w3-dark-grey w3-padding">

        <a href="/backend/pedido/criar" class="w3-button w3-round-large w3-yellow w3-hover-lime w3-margin-bottom w3-large" style="font-weight: 600;">
            <i class="fa fa-plus-circle"></i> Novo Pedido
        </a>
        
        <form action="/backend/pedido/listar" method="POST" class="w3-container w3-padding-small" style="padding: 0!important;">
            <div class="w3-row-padding" style="margin: 0 -16px;">
                <div class="w3-col l4 m6 s12 w3-padding-small">
                    <input 
                        type="text" 
                        name="id_pedido" 
                        class="w3-input w3-border w3-round-large" 
                        placeholder="Buscar por ID, Nome do Cliente ou Endereço..."
                        value="<?= htmlspecialchars($_POST['id_pedido'] ?? '') ?>"
                        style="background-color: #222; color: #fff; border-color: #555;">
                </div>
                <div class="w3-col l2 m3 s12 w3-padding-small">
                    <button type="submit" class="w3-button w3-round-large w3-green w3-hover-khaki w3-block" style="font-weight: 600;">
                        <i class="fa fa-search"></i> Pesquisar
                    </button>
                </div>
                
                <?php if (isset($_POST['id_pedido']) && !empty($_POST['id_pedido'])): ?>
                    <div class="w3-col l2 m3 s12 w3-padding-small">
                        <a href="/backend/pedido/listar/" class="w3-button w3-round-large w3-red w3-hover-pink w3-block">
                            <i class="fa fa-times-circle"></i> Limpar
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </form>
    </div>

<hr style="border-color: #333;">


<?php if (isset($pedidos) && is_array($pedidos) && count($pedidos) > 0): ?>
    <div class="w3-container w3-responsive w3-margin-top">
        <table class="w3-table w3-bordered w3-border w3-hoverable w3-text-white" style="border-collapse: separate; border-spacing: 0 8px;">
            <thead>
                <tr style="background-color: #282828;">
                    <th style="width: 5%;">ID</th>
                    <th style="width: 15%;">Cliente/Perfil</th> 
                    <th style="width: 10%;">Data</th>
                    <th>Endereço</th> 
                    <th style="width: 10%;">Total</th>
                    <th style="width: 5%;" class="w3-center">Itens</th> 
                    <th style="width: 10%;" class="w3-center">Status</th>
                    <th style="width: 15%;" class="w3-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pedidos as $pedido): 
                    $status = strtolower($pedido['status_pedido']);
                    $status_classe = 'w3-dark-grey';
                    $status_icon = 'fa-question-circle';
                    
                    if ($status === 'pago' || $status === 'enviado' || $status === 'concluido') {
                        $status_classe = 'w3-green';
                        $status_icon = 'fa-check-circle';
                    } elseif ($status === 'pendente' || $status === 'em processamento') {
                        $status_classe = 'w3-yellow w3-text-black';
                        $status_icon = 'fa-clock-o';
                    } elseif ($status === 'cancelado') {
                        $status_classe = 'w3-red';
                        $status_icon = 'fa-times-circle';
                    }
                ?>
                <tr class="w3-card w3-dark-grey w3-hover-black" style="border-bottom: 2px solid #333;">
                    <td><?= htmlspecialchars($pedido['id_pedido']) ?></td>
                    <td><?= htmlspecialchars($pedido['nome_cliente'] ?? 'N/A') ?></td> 
                    <td><?= date('d/m/Y H:i', strtotime($pedido['data_pedido'])) ?></td> 
                    <td><?= htmlspecialchars($pedido['endereco_perfil'] ?? 'N/A') ?></td> 
                    
                    <td style="font-weight: 700; color: #ffcc00;">R$ <?= number_format($pedido['total_pedido'], 2, ',', '.') ?></td>
                    
                    <td class="w3-center"><?= htmlspecialchars($pedido['total_itens'] ?? 0) ?></td> 
                    
                    <td class="w3-center">
                        <span class="w3-tag w3-round <?= $status_classe ?>" style="min-width: 90px; padding: 6px 10px; font-weight: 600;">
                            <i class="fa <?= $status_icon ?>"></i> <?= ucfirst(htmlspecialchars($pedido['status_pedido'])) ?>
                        </span>
                    </td>
                    
                    <td class="w3-center w3-padding-small">
                        <a class="w3-button w3-round w3-small w3-teal w3-hover-dark-grey"
                            href="/backend/pedido/detalhes/<?= htmlspecialchars($pedido['id_pedido']) ?>" 
                            title="Detalhes"><i class="fa fa-info-circle"></i></a>
                            
                        <a class="w3-button w3-round w3-small w3-blue w3-hover-dark-grey"
                            href="/backend/pedido/editar/<?= htmlspecialchars($pedido['id_pedido']) ?>"
                            title="Editar"><i class="fa fa-edit"></i></a>
                            
                        <a class="w3-button w3-round w3-small w3-red w3-hover-dark-grey"
                            href="/backend/pedido/deletar/<?= htmlspecialchars($pedido['id_pedido']) ?>"
                            title="Excluir"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    
    <?php if (empty($_POST['id_pedido']) && isset($paginacao)): ?>
        <div class="w3-container w3-padding-16">
            <div class="paginacao-controls" style="display:flex; justify-content:space-between; align-items:center;">
                <div class="page-selector" style="display:flex; align-items:center;">
                    <div class="page-nav">
                        <?php if (($paginacao['pagina_atual'] ?? 1) > 1): ?>
                            <a class="w3-button w3-round w3-dark-grey w3-hover-amber" href="/backend/pedido/listar/<?= $paginacao['pagina_atual'] - 1 ?>">« Anterior</a>
                        <?php endif; ?>
                        <span class="w3-tag w3-amber w3-round-large" style="margin:0 10px; font-weight: 600;">Página <?= $paginacao['pagina_atual'] ?? 1 ?> de <?= $paginacao['ultima_pagina'] ?? 1 ?></span>
                        <?php if (($paginacao['pagina_atual'] ?? 1) < ($paginacao['ultima_pagina'] ?? 1)): ?>
                            <a class="w3-button w3-round w3-dark-grey w3-hover-amber" href="/backend/pedido/listar/<?= $paginacao['pagina_atual'] + 1 ?>">Próximo »</a>
                        <?php endif; ?>
                    </div>
                </div>
                <small class="w3-text-light-grey">
                    Exibindo **<?= $paginacao['de'] ?? 0 ?>** a **<?= $paginacao['para'] ?? 0 ?>** de **<?= $paginacao['total'] ?? 0 ?>** pedidos.
                </small>
            </div>
        </div>
    <?php endif; ?>

<?php else: ?>
    <div class="w3-container w3-panel w3-pale-yellow w3-border w3-round-large w3-margin-top w3-padding-16">
        <p style="color: #000;">
            <i class="fa fa-exclamation-triangle"></i> Nenhum pedido encontrado. 
            <?php if (isset($_POST['id_pedido'])): ?>
                Tente uma nova busca ou <a href="/backend/pedido/listar" class="w3-text-blue">limpe o filtro.</a>
            <?php else: ?>
                <a href="/backend/pedido/criar" class="w3-text-blue">Crie um novo pedido.</a>
            <?php endif; ?>
        </p>
    </div>
<?php endif; ?>

<div style="height: 100px;"></div>