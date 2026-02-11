<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    /* --- VARIÁVEIS KOKETSU PRESET --- */
    :root {
        --accent-gold: #f2cc7d;
        --accent-dim: rgba(197, 160, 45, 0.15);
        --bg-card-dark: #1a1a1a;
        --border-subtle: rgba(255, 255, 255, 0.05);
    }

    /* --- ESTRUTURA E CABEÇALHO --- */
    .koketsu-header-section {
        padding: 30px 15px;
        background: linear-gradient(90deg, rgba(26,26,26,1) 0%, rgba(10,10,10,1) 100%);
        border-radius: 20px;
        margin-bottom: 25px;
        border: 1px solid var(--border-subtle);
    }

    .page-title-main {
        font-size: 24px;
        font-weight: 800;
        letter-spacing: -0.5px;
        color: var(--text-main);
        margin: 0;
    }

    /* --- CARDS DE RESUMO (WIDGETS) --- */
    .summary-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .summary-card {
        background: var(--bg-card);
        padding: 20px;
        border-radius: 16px;
        border: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .summary-icon {
        width: 45px;
        height: 45px;
        background: var(--accent-dim);
        color: var(--accent-gold);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 20px;
    }

    /* --- TABELA ESTILIZADA --- */
    .koketsu-table-wrapper {
        background: transparent;
        border-radius: 20px;
        overflow: hidden;
    }

    .koketsu-table-itens {
        border-collapse: separate;
        border-spacing: 0 10px;
        width: 100%;
    }

    .koketsu-table-itens thead th {
        padding: 15px 20px;
        color: var(--text-muted);
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 1px;
        font-weight: 700;
        border: none;
    }

    .koketsu-table-itens tbody tr {
        background-color: var(--bg-card) !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .koketsu-table-itens tbody tr:hover {
        transform: translateY(-3px);
        background-color: #222 !important;
        box-shadow: 0 8px 20px rgba(0,0,0,0.3);
    }

    .koketsu-table-itens td {
        padding: 20px !important;
        border-top: 1px solid var(--border-color) !important;
        border-bottom: 1px solid var(--border-color) !important;
    }

    /* Arredondamento das linhas */
    .koketsu-table-itens td:first-child { 
        border-left: 1px solid var(--border-color) !important; 
        border-radius: 15px 0 0 15px; 
    }
    .koketsu-table-itens td:last-child { 
        border-right: 1px solid var(--border-color) !important; 
        border-radius: 0 15px 15px 0; 
    }

    /* --- COMPONENTES INTERNOS --- */
    .id-tag {
        background: rgba(255,255,255,0.05);
        padding: 5px 10px;
        border-radius: 8px;
        font-family: 'JetBrains Mono', monospace;
        font-size: 12px;
        color: var(--accent-gold);
    }

    .pedido-link {
        color: var(--text-main);
        text-decoration: none;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .pedido-link:hover { color: var(--accent-gold); }

    .prod-info-box {
        display: flex;
        flex-direction: column;
    }

    .prod-name { font-weight: 800; color: #fff; font-size: 15px; }
    .prod-desc { font-size: 12px; color: #666; }

    .qty-badge {
        background: #000;
        color: var(--accent-gold);
        padding: 4px 12px;
        border-radius: 20px;
        font-weight: 800;
        font-size: 13px;
        border: 1px solid var(--accent-dim);
    }

    .subtotal-value {
        font-family: 'Inter', sans-serif;
        font-weight: 900;
        color: var(--accent-gold);
        font-size: 16px;
    }

    /* --- BOTÕES DE AÇÃO --- */
    .action-group {
        display: flex;
        gap: 8px;
        justify-content: center;
    }

    .btn-circle {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #111;
        border: 1px solid #333;
        color: #aaa;
        transition: 0.2s;
        text-decoration: none;
    }

    .btn-circle:hover {
        background: var(--accent-gold);
        color: #000;
        transform: scale(1.1);
    }

    .btn-delete:hover {
        background: #ff4757;
        color: white;
        border-color: #ff4757;
    }

    /* --- PAGINAÇÃO --- */
    .koketsu-pagination {
        margin-top: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 25px;
        background: var(--bg-card);
        border-radius: 15px;
        border: 1px solid var(--border-color);
    }

    .nav-btn {
        background: #111;
        color: white;
        padding: 8px 18px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        border: 1px solid #333;
    }

    .nav-btn:hover { background: #222; border-color: var(--accent-gold); }
</style>

<div class="koketsu-header-section">
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
        <div>
            <h3 class="page-title-main">
                <i class="fa fa-boxes-stacked" style="color: var(--accent-gold); margin-right: 10px;"></i>
                GERENCIAR ITENS
            </h3>
            <span style="color: #666; font-size: 14px;">Painel de controle de inventário e pedidos</span>
        </div>
        
        <a href="/backend/itenspedidos/criar" class="w3-button btn-novo-item" style="display: flex; align-items: center; gap: 10px; background: var(--accent-gold); color: #000; font-weight: 800; padding: 12px 25px; border-radius: 12px; text-transform: uppercase; font-size: 13px;">
            <i class="fa fa-plus-circle"></i> Novo Lançamento
        </a>
    </div>
</div>

<div class="summary-grid">
    <div class="summary-card">
        <div class="summary-icon"><i class="fa fa-list-ol"></i></div>
        <div>
            <div style="color: #666; font-size: 12px; font-weight: 700; text-transform: uppercase;">Total Itens</div>
            <div style="font-size: 20px; font-weight: 900;"><?= count($itenspedidos) ?></div>
        </div>
    </div>
    <div class="summary-card" style="border-left: 3px solid var(--accent-gold);">
        <div class="summary-icon"><i class="fa fa-chart-line"></i></div>
        <div>
            <div style="color: #666; font-size: 12px; font-weight: 700; text-transform: uppercase;">Fluxo Ativo</div>
            <div style="font-size: 20px; font-weight: 900;">Premium</div>
        </div>
    </div>
</div>

<div class="koketsu-table-wrapper">
    <?php if (isset($itenspedidos) && count($itenspedidos) > 0): ?>
    
    <table class="koketsu-table-itens">
        <thead>
            <tr>
                <th style="width: 10%;">ID Item</th>
                <th style="width: 15%;">Pedido Ref.</th>
                <th>Produto / Especificações</th> 
                <th style="text-align: center; width: 8%;">Qtd</th>
                <th style="width: 12%;">Vlr Unitário</th>
                <th style="width: 15%; text-align: right;">Subtotal Bruto</th>
                <th style="width: 15%; text-align: center;">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($itenspedidos as $itempedido): 
                $subtotal = $itempedido['quantidade'] * $itempedido['preco_unitario'];
            ?>
            <tr>
                <td><span class="id-tag">#<?= $itempedido['id_itens_pedidos'] ?></span></td>
                <td>
                    <a href="/backend/pedido/listar/<?= $itempedido['id_pedido'] ?>" class="pedido-link">
                        <i class="fa fa-file-invoice" style="color: #444;"></i>
                        PED-<?= $itempedido['id_pedido'] ?>
                    </a>
                </td>
                <td>
                    <div class="prod-info-box">
                        <span class="prod-name"><?= htmlspecialchars($produtos['nome_produtos'] ?? 'Produto não identificado') ?></span>
                        <span class="prod-desc">SKU: PROD-00<?= $itempedido['id_produto'] ?></span>
                    </div>
                </td>
                <td style="text-align: center;">
                    <span class="qty-badge"><?= $itempedido['quantidade'] ?></span>
                </td>
                <td>
                    <span style="color: #888; font-size: 14px;">R$</span> 
                    <span style="color: #ccc; font-weight: 600;"><?= number_format($itempedido['preco_unitario'], 2, ',', '.') ?></span>
                </td>
                <td style="text-align: right;">
                    <span class="subtotal-value">R$ <?= number_format($subtotal, 2, ',', '.') ?></span>
                </td>
                <td>
                    <div class="action-group">
                        <a href="/backend/itenspedidos/listar/<?= $itempedido['id_itens_pedidos'] ?>" class="btn-circle" title="Ver Detalhes"><i class="fa fa-eye"></i></a>
                        <a href="/backend/itenspedidos/editar/<?= $itempedido['id_itens_pedidos'] ?>" class="btn-circle" title="Editar"><i class="fa fa-pen-to-square"></i></a>
                        <a href="/backend/itenspedidos/excluir/<?= $itempedido['id_itens_pedidos'] ?>" class="btn-circle btn-delete" title="Excluir"><i class="fa fa-trash-can"></i></a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <div class="koketsu-pagination">
        <span style="color: #666; font-size: 13px; font-weight: 600;">
            Página <span style="color: var(--accent-gold);"><?= $paginacao['pagina_atual'] ?></span> de <?= $paginacao['ultima_pagina'] ?>
        </span>
        
        <div style="display: flex; gap: 10px;">
            <?php if ($paginacao['pagina_atual'] > 1): ?>
                <a href="/backend/itenspedidos/listar/<?= $paginacao['pagina_atual'] - 1 ?>" class="nav-btn"><i class="fa fa-chevron-left"></i> Anterior</a>
            <?php endif; ?>
            
            <?php if ($paginacao['pagina_atual'] < $paginacao['ultima_pagina']): ?>
                <a href="/backend/itenspedidos/listar/<?= $paginacao['pagina_atual'] + 1 ?>" class="nav-btn">Próximo <i class="fa fa-chevron-right"></i></a>
            <?php endif; ?>
        </div>
    </div>
    
    <?php else: ?>
        <div style="background: var(--bg-card); border: 2px dashed #333; border-radius: 20px; padding: 60px; text-align: center; margin-top: 20px;">
            <div style="width: 80px; height: 80px; background: #111; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                <i class="fa fa-box-open" style="font-size: 30px; color: #444;"></i>
            </div>
            <h4 style="color: white; font-weight: 800;">Nenhum item encontrado</h4>
            <p style="color: #666;">A sua base de dados de itens de pedidos está vazia no momento.</p>
            <a href="/backend/itenspedidos/criar" style="color: var(--accent-gold); text-decoration: none; font-weight: 700; text-transform: uppercase; font-size: 12px; letter-spacing: 1px;">Adicionar Primeiro Item</a>
        </div>
    <?php endif; ?>
</div>