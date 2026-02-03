<?php
/**
 * View: Meus Pedidos (cliente)
 * Espera-se: $pedidos (array), opcionalmente $mensagem
 */
?>
<div class="client-orders">
    <header class="orders-header">
        <h2><i class="fa fa-shopping-bag"></i> Meus Pedidos</h2>
        <p class="muted">Aqui você vê todos os pedidos realizados com sua conta</p>
    </header>

    <?php if (!empty($mensagem)): ?>
        <div class="w3-panel w3-yellow w3-round-large" style="margin:18px 0; padding:12px;">
            <?= htmlspecialchars($mensagem) ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($pedidos) && is_array($pedidos)): ?>
        <div class="orders-grid">
            <?php foreach ($pedidos as $pedido): ?>
                <?php $status = strtolower($pedido['status_pedido']); ?>
                <article class="order-card">
                    <div class="order-left">
                        <div class="order-id">#<?= htmlspecialchars($pedido['id_pedido']) ?></div>
                        <div class="order-date"><?= date('d/m/Y H:i', strtotime($pedido['data_pedido'])) ?></div>
                    </div>
                    <div class="order-middle">
                        <div class="order-total">R$ <?= number_format($pedido['total_pedido'],2,',','.') ?></div>
                        <div class="order-address muted"><?= htmlspecialchars($pedido['endereco_perfil'] ?? '') ?></div>
                    </div>
                    <div class="order-right">
                        <div class="order-status <?= $status ?>"><?= ucfirst(htmlspecialchars($pedido['status_pedido'])) ?></div>
                        <a class="details-btn" href="/backend/cliente/pedidos/detalhes/<?= htmlspecialchars($pedido['id_pedido']) ?>">Detalhes →</a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <p>Nenhum pedido encontrado. Faça suas compras e volte aqui para acompanhar o status.</p>
            <a class="w3-button w3-yellow" href="/">Ir para loja</a>
        </div>
    <?php endif; ?>

    <style>
        .orders-header{background:linear-gradient(180deg,#222,#1b1b1d);padding:18px;border-radius:10px;border-top:4px solid #ffd700;color:#fff;margin-bottom:16px}
        .orders-header .muted{color:#aaa;margin-top:6px}
        .orders-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:16px}
        .order-card{display:flex;align-items:center;gap:18px;padding:18px;border-radius:10px;background:linear-gradient(180deg,#1f1f1f,#161616);box-shadow:0 8px 20px rgba(0,0,0,0.6);border:1px solid rgba(255,255,255,0.03)}
        .order-id{font-weight:800;color:#ffd700;font-size:18px}
        .order-date{color:#999;font-size:13px}
        .order-total{font-weight:800;color:#ffd700}
        .order-address{color:#999;font-size:13px}
        .order-status{padding:8px 12px;border-radius:999px;font-weight:700}
        .order-status.pago{background:#093;font-color:#fff;color:#0f0}
        .order-status.pendente{background:#ffc; color:#222}
        .order-status.cancelado{background:#b22;color:#fff}
        .details-btn{display:inline-block;margin-top:8px;color:#ffd700;text-decoration:none;font-weight:700}
        .muted{color:#a8a9ad}
        .empty-state{background:#161616;padding:26px;border-radius:10px;text-align:center;color:#bbb}
    </style>
</div>
