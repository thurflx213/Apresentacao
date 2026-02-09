<style>
    /* Estilos Customizados Koketsu - Itens de Pedidos */
    .koketsu-header-section {
        padding: 20px 8px;
        color: var(--text-main);
    }
    
    .koketsu-table-itens {
        border-collapse: separate;
        border-spacing: 0 12px; /* Efeito de cards separados */
        color: var(--text-main);
        width: 100%;
    }
    
    .koketsu-table-itens thead tr {
        background-color: transparent !important;
        color: var(--text-muted);
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 1.5px;
        font-weight: 800;
    }
    
    .koketsu-table-itens tbody tr {
        background-color: var(--bg-card) !important;
        transition: transform 0.2s, background-color 0.2s, box-shadow 0.2s;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-color);
    }
    
    .koketsu-table-itens tbody tr:hover {
        transform: scale(1.005);
        box-shadow: var(--shadow-md);
        border-color: var(--accent);
    }
    
    .koketsu-table-itens td {
        padding: 18px 15px !important;
        border: none !important;
        vertical-align: middle !important;
    }
    
    /* Arredondar pontas dos "cards" da tabela */
    .koketsu-table-itens td:first-child { border-radius: 12px 0 0 12px; border-left: 1px solid var(--border-color); }
    .koketsu-table-itens td:last-child { border-radius: 0 12px 12px 0; border-right: 1px solid var(--border-color); }

    .id-badge {
        font-family: monospace;
        color: var(--text-muted);
        font-size: 1.1em;
        font-weight: bold;
    }
    
    .link-pedido {
        color: var(--accent);
        text-decoration: none;
        font-weight: 700;
        border-bottom: 1px dashed var(--accent);
        transition: 0.2s;
    }

    .link-pedido:hover {
        color: var(--text-main);
        border-bottom-style: solid;
    }

    .subtotal-gold {
        color: var(--accent);
        font-weight: 800;
        font-size: 1.15em;
    }

    .btn-action-itens {
        background-color: var(--bg-main);
        color: var(--text-main);
        border: 1px solid var(--border-color);
        margin: 0 3px;
        width: 38px;
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: 0.3s;
    }
    
    .btn-action-itens:hover { 
        background-color: var(--accent) !important; 
        color: #000 !important; 
        border-color: var(--accent);
        transform: translateY(-2px);
        box-shadow: var(--shadow-sm);
    }

    .btn-novo-item {
        background: var(--accent) !important;
        color: #000 !important;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 12px 24px;
        transition: 0.3s;
        border-radius: 10px !important;
        box-shadow: 0 4px 15px rgba(197, 160, 45, 0.2);
    }

    .btn-novo-item:hover {
        background: var(--text-main) !important;
        color: var(--bg-main) !important;
        transform: translateY(-2px);
    }
</style>

<div class="koketsu-header-section">
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
        <div>
            <h3 style="margin:0; font-weight: 800; letter-spacing: -1px;">
                <i class="fa fa-shopping-basket" style="color: #f2cc7d;"></i> ITENS DE PEDIDOS
            </h3>
            <p style="margin:0; color: #666; font-size: 14px;">Gerenciamento de produtos vinculados aos pedidos.</p>
        </div>
        
        <a href="/backend/itenspedidos/criar" class="w3-button w3-round-large btn-novo-item">
            <i class="fa fa-plus"></i> Novo Item
        </a>
    </div>
</div>

<div class="w3-container w3-responsive">
    <?php if (isset($itenspedidos) && count($itenspedidos) > 0): ?>
    
    <table class="koketsu-table-itens">
        <thead>
            <tr>
                <th style="width: 8%;">ID Item</th>
                <th style="width: 10%;">ID Pedido</th>
                <th>Produto / Descrição</th> 
                <th style="width: 10%;">Qtd</th>
                <th style="width: 15%;">Unitário</th>
                <th style="width: 15%; text-align: right;">Subtotal</th>
                <th style="width: 15%; text-align: center;">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($itenspedidos as $itempedido): 
                $subtotal = $itempedido['quantidade'] * $itempedido['preco_unitario'];
            ?>
            <tr>
                <td class="id-badge">#<?= htmlspecialchars($itempedido['id_itens_pedidos']) ?></td>
                <td>
                    <a href="/backend/pedido/listar/<?= htmlspecialchars($itempedido['id_pedido']) ?>" class="link-pedido">
                        PED-<?= htmlspecialchars($itempedido['id_pedido']) ?>
                    </a>
                </td>
                <td style="font-weight: 600; color: var(--text-main);">
                    <i class="fa fa-tag" style="font-size: 12px; color: var(--text-muted);"></i> 
                    <?= htmlspecialchars($itempedido['nome_produtos'] ?? 'Produto ID ' . $itempedido['id_produto']) ?>
                </td>
                <td style="font-weight: bold; color: var(--text-main);"><?= htmlspecialchars($itempedido['quantidade']) ?>x</td>
                <td style="color: var(--text-muted);">R$ <?= number_format($itempedido['preco_unitario'], 2, ',', '.') ?></td>
                <td style="text-align: right;" class="subtotal-gold">
                    R$ <?= number_format($subtotal, 2, ',', '.') ?>
                </td>
                <td style="text-align: center;">
                    <div style="display: flex; justify-content: center;">
                        <a class="w3-button w3-round-large btn-action-itens"
                           href="/backend/itenspedidos/listar/<?= htmlspecialchars($itempedido['id_itens_pedidos']) ?>" 
                           title="Detalhes"><i class="fa fa-eye"></i></a>
                           
                        <a class="w3-button w3-round-large btn-action-itens"
                           href="/backend/itenspedidos/editar/<?= htmlspecialchars($itempedido['id_itens_pedidos']) ?>"
                           title="Editar"><i class="fa fa-edit"></i></a>
                           
                        <a class="w3-button w3-round-large btn-action-itens w3-hover-red"
                           href="/backend/itenspedidos/excluir/<?= htmlspecialchars($itempedido['id_itens_pedidos']) ?>"
                           title="Excluir"><i class="fa fa-trash"></i></a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <div style="margin-top: 30px; display: flex; justify-content: space-between; align-items: center; padding-bottom: 40px;">
        <div class="w3-bar" style="background: var(--bg-card); border-radius: 12px; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm);">
          <?php if ($paginacao['pagina_atual'] > 1): ?>
             <a href="/backend/itenspedidos/listar/<?= $paginacao['pagina_atual'] - 1 ?>" class="w3-button w3-text-white w3-hover-amber">« Voltar</a>
          <?php endif; ?>
          
          <span class="w3-button" style="font-weight: bold; pointer-events: none; color: var(--accent);">
             <?= $paginacao['pagina_atual'] ?> / <?= $paginacao['ultima_pagina'] ?>
          </span>
          
          <?php if ($paginacao['pagina_atual'] < $paginacao['ultima_pagina']): ?>
             <a href="/backend/itenspedidos/listar/<?= $paginacao['pagina_atual'] + 1 ?>" class="w3-button w3-text-white w3-hover-amber">Avançar »</a>
          <?php endif; ?>
        </div>
        
        <span style="color: var(--text-muted); font-size: 11px; text-transform: uppercase; font-weight: bold; letter-spacing: 1px;">
            Sessão Administrativa Koketsu
        </span>
    </div>
    
    <?php else: ?>
        <div class="w3-panel w3-round-large" style="background: var(--bg-card); border: 1px dashed var(--border-color); padding: 40px; text-align: center;">
            <i class="fa fa-search w3-text-grey" style="font-size: 40px; margin-bottom: 15px; color: var(--text-muted) !important;"></i>
            <p style="color: var(--text-muted); font-weight: bold;">Nenhum item foi encontrado para esta lista.</p>
            <a href="/backend/itenspedidos/criar" style="color: var(--accent); font-weight: 700;">Clique aqui para adicionar o primeiro item</a>
        </div>
    <?php endif; ?>
</div>

<div style="height: 50px;"></div>