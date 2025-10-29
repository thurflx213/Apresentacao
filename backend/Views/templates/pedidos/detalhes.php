<?php 
// Arquivo: views/templates/pedidos/detalhes.php
// Esta View recebe $pedido e $itens (lista de itens/produtos).

if (empty($pedido)): ?>
    <div class="w3-panel w3-red w3-round-large w3-margin-top w3-margin-bottom" style="margin: 20px;">
        <h3><i class="fa fa-times-circle"></i> Erro!</h3>
        <p>Pedido não encontrado ou ID inválido. Verifique a URL.</p>
    </div>
<?php else: 

    // Lógica para cor do status
    $status = strtolower($pedido['status_pedido'] ?? 'desconhecido');
    $status_classe = 'w3-dark-grey';
    if ($status === 'pago' || $status === 'concluido') {
        $status_classe = 'w3-green';
    } elseif ($status === 'enviado') {
        $status_classe = 'w3-blue';
    } elseif ($status === 'pendente') {
        $status_classe = 'w3-yellow w3-text-black';
    } elseif ($status === 'cancelado') {
        $status_classe = 'w3-red';
    }
?>

<header class="w3-container" style="padding-top:22px">
  <h5><b><i class="fa fa-info-circle"></i> Detalhes do Pedido</b></h5>
</header>

<div class="w3-container w3-margin-bottom" style="max-width: 900px; margin: auto;">
    <h2 class="w3-border-bottom w3-padding-16 w3-text-white" style="font-weight: 500;">
        Pedido #<?= htmlspecialchars($pedido['id_pedido']) ?>
        <span class="w3-tag w3-round w3-large <?= $status_classe ?>" style="float:right; padding: 8px 15px;">
            <i class="fa fa-check-circle"></i> <?= ucfirst(htmlspecialchars($pedido['status_pedido'])) ?>
        </span>
    </h2>

    <div class="w3-card-4 w3-black w3-padding-large w3-margin-bottom w3-text-white" style="border-radius: 8px;">
        
        <h3 class="w3-border-bottom w3-padding-small w3-text-yellow" style="font-weight: 400;"><i class="fa fa-file-text-o"></i> Resumo</h3>
        
        <div class="w3-row-padding">
            <div class="w3-half">
                <p><strong>ID do Cliente:</strong> <span class="w3-text-light-grey"><?= htmlspecialchars($pedido['id_cliente'] ?? 'N/A') ?></span></p>
                <p><strong>Data do Pedido:</strong> <span class="w3-text-light-grey"><?= htmlspecialchars($pedido['data_pedido']) ?></span></p>
            </div>

            <div class="w3-half w3-right-align">
                <p class="w3-xxlarge w3-text-yellow" style="font-weight: 600; margin-bottom: 5px;">
                    R$ <?= number_format($pedido['total_pedido'], 2, ',', '.') ?>
                </p>
                <p class="w3-text-grey">Total Pago/Devido</p>
            </div>
        </div>
        
        <div class="w3-row-padding w3-border-top w3-padding-top w3-small w3-text-grey w3-right-align">
             Criado em: <?= htmlspecialchars($pedido['criado_em']) ?> | Última atualização: <?= htmlspecialchars($pedido['atualizado_em'] ?? 'Nunca') ?>
        </div>
    </div>
    
    <h3 class="w3-border-bottom w3-padding-8 w3-text-white" style="font-weight: 400;">
        <i class="fa fa-shopping-basket"></i> Produtos do Pedido
    </h3>
    
    <?php if (empty($itens)): ?>
        <div class="w3-panel w3-dark-grey w3-padding w3-round w3-text-white">
            <p>Nenhum produto encontrado para este pedido.</p>
        </div>
    <?php else: ?>
        
        <div class="w3-responsive">
        <table class="w3-table w3-bordered w3-hoverable w3-black w3-text-white" style="border-radius: 4px; overflow: hidden;">
            <thead>
                <tr class="w3-dark-grey w3-border-bottom w3-border-yellow">
                    <th>ID Item</th>
                    <th>ID Produto</th>
                    <th>Quantidade</th>
                    <th>Preço Unitário</th>
                    <th style="text-align: right;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($itens as $item): 
                    $subtotal = $item['quantidade'] * $item['preco_unitario'];
                ?>
                <tr>
                    <td><?= htmlspecialchars($item['id_itens_pedidos']) ?></td>
                    <td>
                        <a href="/backend/produto/listar/<?= htmlspecialchars($item['id_produto']) ?>" class="w3-text-teal w3-hover-text-yellow">
                            <?= htmlspecialchars($item['id_produto']) ?>
                        </a>
                    </td>
                    <td><?= htmlspecialchars($item['quantidade']) ?></td>
                    <td>R$ <?= number_format($item['preco_unitario'], 2, ',', '.') ?></td>
                    <td style="text-align: right;">R$ <strong class="w3-text-yellow"><?= number_format($subtotal, 2, ',', '.') ?></strong></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
        
    <?php endif; ?>
    
    <div class="w3-section w3-padding-small w3-right-align w3-border-top w3-padding-top">
        <a href="/backend/pedido/editar/<?= htmlspecialchars($pedido['id_pedido']) ?>"
           class="w3-button w3-round w3-blue w3-hover-dark-grey w3-margin-right">
            <i class="fa fa-edit"></i> Editar Status/Pedido
        </a>
        <a href="/backend/pedido/listar"
           class="w3-button w3-round w3-light-grey w3-hover-dark-grey">
            <i class="fa fa-arrow-left"></i> Voltar à Lista
        </a>
    </div>

</div>

<div style="height: 50px;"></div>

<?php endif; ?>