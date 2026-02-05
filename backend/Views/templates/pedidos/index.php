<style>
    /* Estilos Customizados para a Listagem Koketsu */
    .koketsu-search-card {
        background-color: #1a1a1a !important;
        border: 1px solid #333;
        border-radius: 15px !important;
    }
    .koketsu-table {
        border-collapse: separate;
        border-spacing: 0 10px;
        color: #ddd;
    }
    .koketsu-table thead tr {
        background-color: transparent !important;
        color: #888;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 1px;
    }
    .koketsu-table tbody tr {
        background-color: #1a1a1a !important;
        transition: transform 0.2s, background-color 0.2s;
    }
    .koketsu-table tbody tr:hover {
        background-color: #222 !important;
        transform: scale(1.005);
    }
    .koketsu-table td {
        padding: 15px !important;
        border: none !important;
        vertical-align: middle !important;
    }
    .koketsu-table td:first-child { border-radius: 12px 0 0 12px; }
    .koketsu-table td:last-child { border-radius: 0 12px 12px 0; }

    .price-tag {
        color: #f2cc7d;
        font-weight: 800;
        font-size: 1.1em;
    }
    .status-badge {
        font-size: 11px;
        text-transform: uppercase;
        padding: 6px 12px !important;
        font-weight: 700;
        letter-spacing: 0.5px;
    }
    .btn-action {
        background-color: #333;
        color: #fff;
        border: none;
        margin: 0 2px;
        transition: 0.3s;
    }
    .btn-action:hover { background-color: #f2cc7d !important; color: #000 !important; }
</style>

<header class="w3-container" style="padding-top:20px">
    <div class="w3-row">
        <div class="w3-col l8 m12">
            <h3 style="color: white; font-weight: 700;"><i class="fa fa-list-ul text-yellow"></i> Meus Pedidos</h3>
        </div>
    </div>

    <div class="w3-panel koketsu-search-card w3-padding-16">
        <div class="w3-row-padding">
            <div class="w3-col l3 m12 w3-margin-bottom">
                <a href="/backend/pedido/criar" class="w3-button w3-round-large w3-block" 
                   style="background: #f2cc7d; color: #000; font-weight: 900; height: 45px; padding-top: 10px;">
                    <i class="fa fa-plus"></i> NOVO PEDIDO
                </a>
            </div>
            
            <div class="w3-col l9 m12">
                <form action="/backend/pedido/listar" method="POST">
                    <div style="display: flex; gap: 10px;">
                        <input type="text" name="id_pedido" 
                               class="w3-input w3-round-large" 
                               placeholder="Pesquisar por ID, cliente ou endereço..."
                               value="<?= htmlspecialchars($_POST['id_pedido'] ?? '') ?>"
                               style="background-color: #111; color: #fff; border: 1px solid #444; height: 45px;">
                        
                        <button type="submit" class="w3-button w3-round-large w3-grey w3-hover-amber" style="height: 45px; font-weight: 700;">
                            <i class="fa fa-search"></i>
                        </button>

                        <?php if (!empty($_POST['id_pedido'])): ?>
                            <a href="/backend/pedido/listar/" class="w3-button w3-round-large w3-red" style="height: 45px; padding-top: 10px;">
                                <i class="fa fa-times"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php if (isset($pedidos) && is_array($pedidos) && count($pedidos) > 0): ?>
    <div class="w3-responsive" style="padding: 0 8px;">
        <table class="w3-table koketsu-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th> 
                    <th>Data</th>
                    <th>Endereço</th> 
                    <th>Total</th>
                    <th class="w3-center">Status</th>
                    <th class="w3-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pedidos as $pedido): 
                    $status = strtolower($pedido['status_pedido']);
                    $bg_badge = 'w3-grey';
                    
                    if (in_array($status, ['pago', 'enviado', 'concluido'])) $bg_badge = 'w3-green';
                    elseif (in_array($status, ['pendente', 'em processamento'])) $bg_badge = 'w3-amber w3-text-black';
                    elseif ($status === 'cancelado') $bg_badge = 'w3-red';
                ?>
                <tr>
                    <td style="color: #666; font-family: monospace;">#<?= $pedido['id_pedido'] ?></td>
                    <td style="font-weight: 600; color: #fff;"><?= htmlspecialchars($pedido['nome_cliente'] ?? 'N/A') ?></td> 
                    <td style="font-size: 0.9em; color: #888;"><?= date('d/m/y H:i', strtotime($pedido['data_pedido'])) ?></td> 
                    <td style="font-size: 0.85em; max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                        <?= htmlspecialchars($pedido['endereco_perfil'] ?? 'Sem endereço') ?>
                    </td> 
                    <td class="price-tag">R$ <?= number_format($pedido['total_pedido'], 2, ',', '.') ?></td>
                    
                    <td class="w3-center">
                        <span class="w3-tag w3-round-large status-badge <?= $bg_badge ?>">
                            <?= ucfirst(htmlspecialchars($pedido['status_pedido'])) ?>
                        </span>
                    </td>
                    
                    <td class="w3-center">
                        <div style="display: flex; justify-content: center;">
                            <a class="w3-button w3-round-large btn-action" href="/backend/pedido/detalhes/<?= $pedido['id_pedido'] ?>" title="Ver"><i class="fa fa-eye"></i></a>
                            <a class="w3-button w3-round-large btn-action" href="/backend/pedido/editar/<?= $pedido['id_pedido'] ?>" title="Editar"><i class="fa fa-edit"></i></a>
                            <a class="w3-button w3-round-large btn-action w3-hover-red" href="/backend/pedido/deletar/<?= $pedido['id_pedido'] ?>" title="Excluir"><i class="fa fa-trash"></i></a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php if (empty($_POST['id_pedido']) && isset($paginacao)): ?>
        <div class="w3-container w3-padding-32">
            <div style="display:flex; justify-content:space-between; align-items:center;">
                <div class="w3-bar koketsu-search-card">
                    <?php if (($paginacao['pagina_atual'] ?? 1) > 1): ?>
                        <a href="/backend/pedido/listar/<?= $paginacao['pagina_atual'] - 1 ?>" class="w3-button w3-text-white">«</a>
                    <?php endif; ?>
                    
                    <button class="w3-button" style="background: #f2cc7d; color: #000; font-weight: 900;">
                        Página <?= $paginacao['pagina_atual'] ?>
                    </button>
                    
                    <?php if (($paginacao['pagina_atual'] ?? 1) < ($paginacao['ultima_pagina'] ?? 1)): ?>
                        <a href="/backend/pedido/listar/<?= $paginacao['pagina_atual'] + 1 ?>" class="w3-button w3-text-white">»</a>
                    <?php endif; ?>
                </div>
                <span style="color: #555; font-size: 12px; font-weight: 700; text-transform: uppercase;">
                    Total: <?= $paginacao['total'] ?? 0 ?> Pedidos
                </span>
            </div>
        </div>
    <?php endif; ?>

    <?php else: ?>
        <div class="w3-center w3-padding-64">
            <i class="fa fa-folder-open-o w3-text-grey" style="font-size: 48px;"></i>
            <p class="w3-text-grey">Nenhum pedido encontrado nesta busca.</p>
            <a href="/backend/pedido/listar" class="w3-text-amber">Limpar filtros e voltar</a>
        </div>
    <?php endif; ?>
</header>