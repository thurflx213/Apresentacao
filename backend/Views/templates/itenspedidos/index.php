<style>
    /* Estilos Customizados Koketsu - Itens de Pedidos */
    .koketsu-header-section {
        padding: 20px 8px;
        color: white;
    }
    
    .koketsu-table-itens {
        border-collapse: separate;
        border-spacing: 0 10px; /* Efeito de cards separados */
        color: #ddd;
        width: 100%;
    }
    
    .koketsu-table-itens thead tr {
        background-color: transparent !important;
        color: #888;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 1.5px;
    }
    
    .koketsu-table-itens tbody tr {
        background-color: #1a1a1a !important;
        transition: transform 0.2s, background-color 0.2s;
        box-shadow: 0 4px 6px rgba(0,0,0,0.3);
    }
    
    .koketsu-table-itens tbody tr:hover {
        background-color: #222 !important;
        transform: scale(1.005);
    }
    
    .koketsu-table-itens td {
        padding: 18px 15px !important;
        border: none !important;
        vertical-align: middle !important;
    }
    
    /* Arredondar pontas dos "cards" da tabela */
    .koketsu-table-itens td:first-child { border-radius: 12px 0 0 12px; }
    .koketsu-table-itens td:last-child { border-radius: 0 12px 12px 0; }

    .id-badge {
        font-family: monospace;
        color: #666;
        font-size: 1.1em;
    }
    
    .link-pedido {
        color: #5bc0de;
        text-decoration: none;
        font-weight: bold;
        border-bottom: 1px dashed #5bc0de;
    }

    .subtotal-gold {
        color: #f2cc7d;
        font-weight: 800;
        font-size: 1.15em;
    }

    .btn-action-itens {
        background-color: #282828;
        color: #fff;
        border: none;
        margin: 0 3px;
        width: 35px;
        height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: 0.3s;
    }
    
    .btn-action-itens:hover { 
        background-color: #f2cc7d !important; 
        color: #000 !important; 
        transform: translateY(-2px);
    }

    .btn-novo-item {
        background: #f2cc7d;
        color: #000;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 12px 24px;
        transition: 0.3s;
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
                <td style="font-weight: 600; color: #fff;">
                    <i class="fa fa-tag" style="font-size: 12px; color: #444;"></i> 
                    <?= htmlspecialchars($itempedido['nome_produtos'] ?? 'Produto ID ' . $itempedido['id_produto']) ?>
                </td>
                <td style="font-weight: bold;"><?= htmlspecialchars($itempedido['quantidade']) ?>x</td>
                <td style="color: #888;">R$ <?= number_format($itempedido['preco_unitario'], 2, ',', '.') ?></td>
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
        <div class="w3-bar" style="background: #1a1a1a; border-radius: 12px; border: 1px solid #333;">
          <?php if ($paginacao['pagina_atual'] > 1): ?>
             <a href="/backend/itenspedidos/listar/<?= $paginacao['pagina_atual'] - 1 ?>" class="w3-button w3-text-white w3-hover-amber">« Voltar</a>
          <?php endif; ?>
          
          <span class="w3-button w3-text-amber" style="font-weight: bold; pointer-events: none;">
             <?= $paginacao['pagina_atual'] ?> / <?= $paginacao['ultima_pagina'] ?>
          </span>
          
          <?php if ($paginacao['pagina_atual'] < $paginacao['ultima_pagina']): ?>
             <a href="/backend/itenspedidos/listar/<?= $paginacao['pagina_atual'] + 1 ?>" class="w3-button w3-text-white w3-hover-amber">Avançar »</a>
          <?php endif; ?>
        </div>
        
        <span style="color: #444; font-size: 11px; text-transform: uppercase; font-weight: bold; letter-spacing: 1px;">
            Sessão Administrativa Koketsu
        </span>
    </div>
    
    <?php else: ?>
        <div class="w3-panel w3-round-large" style="background: #1a1a1a; border: 1px dashed #444; padding: 40px; text-align: center;">
            <i class="fa fa-search w3-text-grey" style="font-size: 40px; margin-bottom: 15px;"></i>
            <p style="color: #888; font-weight: bold;">Nenhum item foi encontrado para esta lista.</p>
            <a href="/backend/itenspedidos/criar" class="w3-text-amber">Clique aqui para adicionar o primeiro item</a>
        </div>
    <?php endif; ?>
</div>

<div style="height: 50px;"></div>