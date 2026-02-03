<?php
/**
 * View: Detalhes do Pedido (cliente)
 * Espera-se: $pedido, $itens
 */
?>
<div class="order-details">
    <header class="details-header">
        <h2>Pedido #<?= htmlspecialchars($pedido['id_pedido']) ?></h2>
        <div class="status">Status: <strong><?= htmlspecialchars(ucfirst($pedido['status_pedido'])) ?></strong></div>
    </header>

    <section class="details-meta">
        <div><strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($pedido['data_pedido'])) ?></div>
        <div><strong>Total:</strong> R$ <?= number_format($pedido['total_pedido'],2,',','.') ?></div>
        <div><strong>Endereço:</strong> <?= htmlspecialchars($pedido['endereco_perfil'] ?? '') ?></div>
    </section>

    <section class="items-table">
        <h3>Itens do Pedido</h3>
        <?php if (!empty($itens)): ?>
            <table style="width:100%; border-collapse:collapse;">
                <thead>
                    <tr style="text-align:left; color:#aaa; font-weight:700;">
                        <td>Produto</td>
                        <td>Quantidade</td>
                        <td>Preço Unit.</td>
                        <td>Subtotal</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($itens as $it): ?>
                        <tr style="border-top:1px solid rgba(255,255,255,0.03);">
                            <td><?= htmlspecialchars($it['nome_produtos'] ?? 'Produto') ?></td>
                            <td><?= htmlspecialchars($it['quantidade_itens_pedidos'] ?? 0) ?></td>
                            <td>R$ <?= number_format($it['preco_unitario'] ?? 0,2,',','.') ?></td>
                            <td>R$ <?= number_format(($it['quantidade_itens_pedidos'] * ($it['preco_unitario'] ?? 0)),2,',','.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="muted">Nenhum item encontrado para este pedido.</p>
        <?php endif; ?>
    </section>

    <div style="margin-top:18px;">
        <a class="w3-button w3-grey" href="/backend/cliente/pedidos">← Voltar</a>
    </div>

    <style>
        .details-header{display:flex;justify-content:space-between;align-items:center;background:linear-gradient(180deg,#222,#1b1b1d);padding:14px;border-radius:8px;border-top:4px solid #ffd700;color:#fff;margin-bottom:12px}
        .details-meta{display:flex;gap:20px;color:#ccc;margin-bottom:12px}
        .items-table h3{color:#fff;margin-bottom:8px}
        .muted{color:#a8a9ad}
    </style>
</div>
