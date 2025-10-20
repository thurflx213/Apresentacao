<?php 
// Esta View recebe a variável $itempedido do Controller
if (empty($itempedido)): ?>
  <div class="w3-panel w3-red w3-round-large" style="margin: 20px;">
    <h3>Erro!</h3>
    <p>Item Pedido não encontrado ou ID inválido. Verifique a URL.</p>
  </div>
<?php else: ?>

<header class="w3-container" style="padding-top:22px"> 
    <!-- CORRIGIDO: Usa id_itens_pedidos -->
    <h5><b><i class="fa fa-clipboard-list"></i> Detalhes do Item do Pedido #<?= htmlspecialchars($itempedido['id_itens_pedidos']) ?></b></h5>
</header>

<div class="w3-container w3-margin-bottom" style="max-width: 800px;">
  <h2 class="w3-border-bottom w3-padding-16">
    <!-- CORRIGIDO: Usa id_itens_pedidos -->
    Item Pedido #<?= htmlspecialchars($itempedido['id_itens_pedidos']) ?>
  </h2>

  <div class="w3-card-4 w3-white w3-padding">
    <!-- CORRIGIDO: Usa id_itens_pedidos -->
    <p><strong>ID do Item Pedido:</strong> <?= htmlspecialchars($itempedido['id_itens_pedidos']) ?></p>
    <p><strong>ID do Pedido Relacionado:</strong> <?= htmlspecialchars($itempedido['id_pedido']) ?></p>
    <p><strong>ID do Produto:</strong> <?= htmlspecialchars($itempedido['id_produto']) ?></p>
    <p><strong>Quantidade Comprada:</strong> <?= htmlspecialchars($itempedido['quantidade']) ?></p>
    <p><strong>Preço Unitário:</strong> R$ <?= number_format($itempedido['preco_unitario'], 2, ',', '.') ?></p>
    <p><strong>Subtotal (Cálculo da View):</strong> R$ <?= number_format($itempedido['quantidade'] * $itempedido['preco_unitario'], 2, ',', '.') ?></p>
    <p><strong>Criado em:</strong> <?= htmlspecialchars($itempedido['criado_em']) ?></p>

    <div class="w3-section w3-border-top w3-padding-small w3-right-align">
      <!-- CORRIGIDO: Usa id_itens_pedidos no link de edição -->
      <a href="/backend/itenspedidos/editar/<?= htmlspecialchars($itempedido['id_itens_pedidos']) ?>"
       class="w3-button w3-round w3-blue w3-hover-dark-grey w3-margin-right">
        <i class="fa fa-edit"></i> Editar
      </a>
      <a href="/backend/itenspedidos/listar/1"
       class="w3-button w3-round w3-light-grey w3-hover-dark-grey">
        <i class="fa fa-arrow-left"></i> Voltar à Lista
      </a>
    </div>
</div>
</div>

<?php endif; ?>
