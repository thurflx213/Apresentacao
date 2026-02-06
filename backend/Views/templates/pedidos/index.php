<?php
// Calcular estatísticas de pedidos
$total_pedidos = $total_pedidos ?? 0;
$total_ativos = 0;
$total_inativos = 0;
$total_valor = 0;

foreach ($pedidos as $p) {
    if (empty($p['excluido_em'])) {
        $total_ativos++;
        $total_valor += $p['total_pedido'];
    } else {
        $total_inativos++;
    }
}
?>

<style>
    /* --- AJUSTES GERAIS DE LAYOUT --- */
    .page-wrapper {
        padding: 20px;
        width: 100%;
        box-sizing: border-box;
        background-color: #0c0c0c;
        min-height: 100vh;
    }

    .page-title {
        font-size: 26px;
        font-weight: 800;
        margin-bottom: 5px;
        color: #ffffff;
        text-transform: uppercase;
        letter-spacing: -1px;
    }

    .header-breadcrumb {
        color: #888;
        margin-bottom: 25px;
        padding-bottom: 10px;
        border-bottom: 1px solid #222;
    }

    /* --- DASHBOARD CARDS PREMIUM --- */
    .dashboard-grid {
        display: flex;
        gap: 20px;
        margin-bottom: 30px;
        flex-wrap: wrap;
    }

    .stat-card {
        flex: 1;
        min-width: 220px;
        background: #1a1a1a;
        border: 1px solid #333;
        border-radius: 15px;
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: 0.3s;
    }

    .stat-card:hover { border-color: #f2cc7d; transform: translateY(-5px); }

    .stat-icon {
        font-size: 30px;
        color: #f2cc7d;
        background: rgba(242, 204, 125, 0.1);
        width: 55px;
        height: 55px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
    }

    .stat-info h3 { margin: 0; font-size: 28px; color: #fff; font-weight: 800; }
    .stat-info p { margin: 0; color: #666; text-transform: uppercase; font-size: 11px; letter-spacing: 1px; font-weight: 700; }

    /* --- ÁREA DE AÇÕES (BOTÃO + PESQUISA) --- */
    .actions-bar {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        gap: 20px;
        margin-bottom: 25px;
        flex-wrap: wrap;
    }

    .btn-main-action {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background-color: #f2cc7d !important;
        color: #000 !important;
        padding: 14px 24px;
        border-radius: 10px;
        font-weight: 800;
        text-transform: uppercase;
        font-size: 13px;
        letter-spacing: 0.5px;
        text-decoration: none;
        transition: 0.3s;
        border: none;
        box-shadow: 0 4px 15px rgba(242, 204, 125, 0.2);
        white-space: nowrap;
    }

    .btn-main-action:hover { background-color: #ffffff !important; transform: scale(1.02); }

    /* Estilo da Barra de Pesquisa */
    .search-container {
        position: relative;
        flex: 1;
        max-width: 400px;
    }

    .search-container i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #f2cc7d;
    }

    .search-input {
        width: 100%;
        background: #1a1a1a;
        border: 1px solid #333;
        padding: 13px 15px 13px 45px;
        border-radius: 10px;
        color: #fff;
        font-size: 14px;
        transition: 0.3s;
        outline: none;
    }

    .search-input:focus {
        border-color: #f2cc7d;
        background: #222;
        box-shadow: 0 0 10px rgba(242, 204, 125, 0.1);
    }

    /* --- TABELA DE PEDIDOS --- */
    .order-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 10px;
        color: #ddd;
    }

    .order-table thead th {
        color: #ffffff !important;
        text-transform: uppercase;
        font-size: 12px;
        padding: 15px;
        letter-spacing: 1.5px;
        font-weight: 800;
    }

    .order-table tbody tr {
        background: #161616;
        transition: 0.2s;
        box-shadow: 0 4px 6px rgba(0,0,0,0.2);
        position: relative;
    }

    .order-table tbody tr:hover { background: #1f1f1f; }

    .order-table td { padding: 18px 15px !important; border: none; vertical-align: middle; }
    .order-table td:first-child { border-radius: 12px 0 0 12px; }
    .order-table td:last-child { border-radius: 0 12px 12px 0; }

    .id-column { font-family: monospace; color: #aaa !important; font-weight: bold; }
    .client-column { font-weight: 700; color: #fff; font-size: 1.05em; }
    .price-column { color: #f2cc7d; font-weight: 800; font-size: 1.1em; }

    .badge-status { padding: 6px 14px; border-radius: 8px; font-size: 10px; font-weight: 900; text-transform: uppercase; }
    .badge-pago, .badge-concluido, .badge-enviado { background: #d4edda; color: #155724; }
    .badge-pendente, .badge-processamento { background: #fff3cd; color: #856404; }
    .badge-cancelado { background: #f8d7da; color: #721c24; }

    .btn-action-small { padding: 8px 14px; border-radius: 8px; font-size: 11px; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 5px; transition: 0.3s; margin: 0 2px; }
    .btn-view { background: #222; color: #4dabf7; border: 1px solid #4dabf7; }
    .btn-view:hover { background: #4dabf7; color: #000; }
    .btn-edit { background: #222; color: #f2cc7d; border: 1px solid #f2cc7d; }
    .btn-edit:hover { background: #f2cc7d; color: #000; }
    .btn-delete { background: transparent; border: 1px solid #444; color: #999; }
    .btn-delete:hover { border-color: #ff4444; color: #ff4444; }
    .btn-activate { background: transparent; border: 1px solid #4caf50; color: #4caf50; }
    .btn-activate:hover { background: #4caf50; color: #fff; }

    /* Pedidos Excluídos */
    .tr-deleted { 
        opacity: 0.5; 
        filter: grayscale(0.8);
    }

    .tr-deleted::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: #e63946;
        border-radius: 12px 0 0 12px;
    }

    .tr-deleted .price-column {
        text-decoration: line-through;
        color: #888 !important;
    }

    .badge-deleted {
        background: #e63946;
        color: #fff;
        padding: 2px 6px;
        border-radius: 4px;
        font-size: 9px;
        margin-left: 5px;
    }
</style>

<div class="page-wrapper">
    <h3 class="page-title"><i class="fa fa-shopping-cart" style="color: #f2cc7d;"></i> Gerenciar Pedidos</h3>

    <header class="header-breadcrumb">
        <h5><b><i class="fa fa-dashboard"></i> Painel de Controle - Koketsu</b></h5>
    </header>

    <div class="actions-bar">
        <a href="/backend/pedido/criar" class="btn-main-action">
            <i class="fa fa-plus-circle"></i> Novo Pedido
        </a>

        <div class="search-container">
            <i class="fa fa-search"></i>
            <input type="text" id="orderInput" onkeyup="filterOrders()" placeholder="Buscar pedido por ID ou cliente..." class="search-input">
        </div>
    </div>

    <main>
        <table class="order-table" id="orderTable">
            <thead>
                <tr>
                    <th style="width: 100px;">ID</th>
                    <th>Cliente</th>
                    <th>Data</th>
                    <th>Endereço</th>
                    <th style="text-align: right;">Total</th>
                    <th style="text-align: center;">Status</th>
                    <th style="text-align: center;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($pedidos) && is_array($pedidos) && count($pedidos) > 0): ?>
                    <?php foreach ($pedidos as $pedido): 
                        $is_deleted = !empty($pedido['excluido_em']);
                        $status = strtolower($pedido['status_pedido']);
                        $badge_class = 'badge-pendente';
                        
                        if (in_array($status, ['pago', 'enviado', 'concluido'])) {
                            $badge_class = 'badge-pago';
                        } elseif ($status === 'cancelado') {
                            $badge_class = 'badge-cancelado';
                        }
                    ?>
                    <tr class="<?= $is_deleted ? 'tr-deleted' : '' ?>">
                        <td class="id-column order-id">
                            #<?= $pedido['id_pedido'] ?>
                            <?php if ($is_deleted): ?>
                                <span class="badge-deleted">EXCLUÍDO</span>
                            <?php endif; ?>
                        </td>
                        <td class="client-column"><?= htmlspecialchars($pedido['nome_cliente'] ?? 'N/A') ?></td>
                        <td style="color: #888; font-size: 0.9em;"><?= date('d/m/y H:i', strtotime($pedido['data_pedido'])) ?></td>
                        <td style="color: #999; font-size: 0.85em; max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                            <?= htmlspecialchars($pedido['endereco_perfil'] ?? 'Sem endereço') ?>
                        </td>
                        <td class="price-column" style="text-align: right;">R$ <?= number_format($pedido['total_pedido'], 2, ',', '.') ?></td>
                        
                        <td style="text-align: center;">
                            <span class="badge-status <?= $badge_class ?>">
                                <?= ucfirst(htmlspecialchars($pedido['status_pedido'])) ?>
                            </span>
                        </td>
                        
                        <td style="text-align: center;">
                            <a href="/backend/pedido/detalhes/<?= $pedido['id_pedido'] ?>" class="btn-action-small btn-view">
                                <i class="fa fa-eye"></i> Ver
                            </a>
                            
                            <?php if (!$is_deleted): ?>
                                <a href="/backend/pedido/editar/<?= $pedido['id_pedido'] ?>" class="btn-action-small btn-edit">
                                    <i class="fa fa-pencil"></i> Editar
                                </a>
                                <a href="/backend/pedido/excluir/<?= $pedido['id_pedido'] ?>" class="btn-action-small btn-delete">
                                    <i class="fa fa-trash"></i> Excluir
                                </a>
                            <?php else: ?>
                                <a href="/backend/pedido/ativar/<?= $pedido['id_pedido'] ?>" class="btn-action-small btn-activate">
                                    <i class="fa fa-check"></i> Ativar
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 40px; color: #666;">
                            <i class="fa fa-folder-open-o" style="font-size: 48px; display: block; margin-bottom: 15px;"></i>
                            Nenhum pedido encontrado.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</div>

<div style="height: 60px;"></div>

<script>
function filterOrders() {
    var input, filter, table, tr, td_id, td_client, i, idValue, clientValue;
    input = document.getElementById("orderInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("orderTable");
    tr = table.getElementsByTagName("tr");

    for (i = 1; i < tr.length; i++) {
        td_id = tr[i].getElementsByClassName("order-id")[0];
        td_client = tr[i].getElementsByClassName("client-column")[0];
        
        if (td_id && td_client) {
            idValue = td_id.textContent || td_id.innerText;
            clientValue = td_client.textContent || td_client.innerText;
            
            if (idValue.toUpperCase().indexOf(filter) > -1 || clientValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
</script>