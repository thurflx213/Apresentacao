<?php
// Funções auxiliares para status de pedido
function getStatusClass($status) {
    switch(strtolower($status)) {
        case 'pago': case 'concluido': return 'status-success';
        case 'pendente': return 'status-warning';
        case 'cancelado': return 'status-danger';
        case 'enviado': return 'status-info';
        default: return 'status-muted';
    }
}
?>

<div class="client-dashboard">
    <!-- Header com Efeito Glass -->
    <header class="dash-header-glass">
        <div class="user-info">
            <div class="welcome-text">
                <h2>👋 Bem-vindo, <span class="accent-text"><?= htmlspecialchars($nomeUsuario ?? 'Cliente') ?></span></h2>
                <p>Aqui está o resumo da sua conta hoje.</p>
            </div>
        </div>
        <div class="quick-stats">
            <div class="stat-item">
                <span class="stat-value"><?= $totalPedidos ?? 0 ?></span>
                <span class="stat-label">Pedidos Realizados</span>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-item">
                <span class="stat-value"><i class="fa fa-star text-yellow"></i></span>
                <span class="stat-label">Cliente VIP</span>
            </div>
        </div>
    </header>

    <!-- Grid de Ações Principais -->
    <section class="action-grid">
        <a href="/backend/cliente/meu-perfil/<?= htmlspecialchars($usuarioId ?? '0') ?>" class="glass-card action-card">
            <div class="card-glow"></div>
            <div class="icon-box purple"><i class="fa fa-user-circle"></i></div>
            <div class="card-content">
                <h3>Meu Perfil</h3>
                <p>Gerencie seus dados e foto</p>
            </div>
            <i class="fa fa-chevron-right arrow"></i>
        </a>

        <a href="/backend/cliente/pedidos" class="glass-card action-card">
            <div class="card-glow"></div>
            <div class="icon-box gold"><i class="fa fa-shopping-bag"></i></div>
            <div class="card-content">
                <h3>Meus Pedidos</h3>
                <p>Acompanhe suas compras</p>
            </div>
            <i class="fa fa-chevron-right arrow"></i>
        </a>

        <a href="/backend/configuracoes" class="glass-card action-card">
            <div class="card-glow"></div>
            <div class="icon-box blue"><i class="fa fa-sliders"></i></div>
            <div class="card-content">
                <h3>Configurações</h3>
                <p>Preferências da conta</p>
            </div>
            <i class="fa fa-chevron-right arrow"></i>
        </a>
    </section>

    <!-- Pedidos Recentes & Atalhos -->
    <div class="dash-row">
        <section class="glass-card recent-orders-col">
            <div class="section-header">
                <h3><i class="fa fa-history"></i> Compras Recentes</h3>
                <a href="/backend/cliente/pedidos" class="view-all">Ver todos</a>
            </div>
            
            <div class="orders-list">
                <?php if (empty($pedidosRecentes)): ?>
                    <div class="empty-state">
                        <i class="fa fa-shopping-cart"></i>
                        <p>Você ainda não realizou nenhum pedido.</p>
                        <a href="/" class="shop-now">Ir para a Loja</a>
                    </div>
                <?php else: ?>
                    <table class="modern-table">
                        <thead>
                            <tr>
                                <th>Pedido</th>
                                <th>Data</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pedidosRecentes as $pedido): ?>
                            <tr>
                                <td>#<?= $pedido['id_pedido'] ?></td>
                                <td><?= date('d/m/Y', strtotime($pedido['data_pedido'])) ?></td>
                                <td class="price">R$ <?= number_format($pedido['total_pedido'], 2, ',', '.') ?></td>
                                <td>
                                    <span class="status-badge <?= getStatusClass($pedido['status_pedido']) ?>">
                                        <?= ucfirst($pedido['status_pedido']) ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="/backend/cliente/pedidos/detalhes/<?= $pedido['id_pedido'] ?>" class="btn-detail icon-only" title="Ver Detalhes">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </section>

        <section class="glass-card support-col">
            <h3><i class="fa fa-headset"></i> Precisa de ajuda?</h3>
            <p>Nossa equipe está pronta para te atender.</p>
            <div class="support-actions">
                <a href="#" class="support-btn"><i class="fa fa-whatsapp"></i> WhatsApp</a>
                <a href="#" class="support-btn"><i class="fa fa-envelope"></i> Email</a>
            </div>
        </section>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap');

    :root {
        --accent: #ffd700;
        --accent-glow: rgba(255, 215, 0, 0.2);
        --text-muted: #a0a0a5;
        --text-main: #fff; /* Added text-main variable */
        --border-color: rgba(255,255,255,0.08); /* Added border-color variable */
    }

    /* Glass Header */
    .dash-header-glass {
        background: var(--glass-bg);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        padding: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    }

    .accent-text { color: var(--accent); font-weight: 700; }
    .dash-header-glass h2 { margin: 0; font-size: 26px; color: var(--text-main); }
    .dash-header-glass p { margin: 5px 0 0; color: var(--text-muted); }

    .quick-stats { display: flex; align-items: center; gap: 30px; }
    .stat-item { text-align: center; }
    .stat-value { display: block; font-size: 22px; font-weight: 700; color: var(--text-main); }
    .stat-label { font-size: 13px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; }
    .stat-divider { width: 1px; height: 40px; background: var(--border-color); }

    .glass-card {
        background: var(--glass-bg);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid var(--glass-border);
        border-radius: 18px;
        padding: 24px;
        position: relative;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .action-card {
        text-decoration: none;
        color: #fff;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .action-card:hover {
        transform: translateY(-8px);
        border-color: var(--accent);
        box-shadow: 0 20px 40px rgba(0,0,0,0.5);
    }

    .card-glow {
        position: absolute;
        width: 150px;
        height: 150px;
        background: var(--accent-glow);
        filter: blur(60px);
        border-radius: 50%;
        top: -50px;
        right: -50px;
        opacity: 0;
        transition: 0.3s;
    }
    .action-card:hover .card-glow { opacity: 1; }

    .icon-box {
        width: 54px;
        height: 54px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        flex-shrink: 0;
    }
    .icon-box.purple { background: linear-gradient(135deg, #6e45e2, #88d3ce); }
    .icon-box.gold { background: linear-gradient(135deg, #fce38a, #f38181); }
    .icon-box.blue { background: linear-gradient(135deg, #4facfe, #00f2fe); }

    .card-content h3 { margin: 0; font-size: 18px; }
    .card-content p { margin: 4px 0 0; font-size: 13px; color: var(--text-muted); }
    .arrow { margin-left: auto; color: rgba(255,255,255,0.2); transition: 0.3s; }
    .action-card:hover .arrow { color: var(--accent); transform: translateX(5px); }

    /* Rows */
    .dash-row { display: flex; gap: 20px; }
    .recent-orders-col { flex: 2; }
    .support-col { flex: 1; display: flex; flex-direction: column; align-items: center; text-align: center; }

    .section-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    .section-header h3 { margin: 0; font-size: 18px; color: var(--accent); }
    .view-all { font-size: 13px; color: var(--text-muted); text-decoration: none; }
    .view-all:hover { color: #fff; }

    /* Table */
    .modern-table { width: 100%; border-collapse: collapse; }
    .modern-table th { text-align: left; padding: 12px; font-size: 11px; color: var(--text-muted); font-weight: 700; text-transform: uppercase; letter-spacing: 1px; border-bottom: 2px solid var(--border-color); }
    .modern-table td { padding: 16px 12px; border-bottom: 1px solid var(--border-color); font-size: 14px; color: var(--text-main); }
    .price { font-weight: 700; color: var(--text-main); }

    /* Badges */
    .status-badge {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .status-success { background: rgba(39, 174, 96, 0.12); color: #2ecc71; border: 1px solid rgba(39, 174, 96, 0.2); }
    .status-warning { background: rgba(243, 156, 18, 0.12); color: #f1c40f; border: 1px solid rgba(243, 156, 18, 0.2); }
    .status-danger { background: rgba(231, 76, 60, 0.12); color: #e74c3c; border: 1px solid rgba(231, 76, 60, 0.2); }
    .status-info { background: rgba(52, 152, 219, 0.12); color: #3498db; border: 1px solid rgba(52, 152, 219, 0.2); }

    .btn-detail { width: 32px; height: 32px; border-radius: 8px; background: var(--border-color); display: flex; align-items: center; justify-content: center; color: var(--text-muted); text-decoration: none; transition: 0.3s; }
    .btn-detail:hover { background: var(--accent); color: #000; }

    /* Empty State */
    .empty-state { padding: 40px; text-align: center; color: var(--text-muted); }
    .empty-state i { font-size: 40px; margin-bottom: 15px; opacity: 0.3; }
    .shop-now { display: inline-block; margin-top: 15px; padding: 10px 20px; background: var(--accent); color: #111; border-radius: 30px; text-decoration: none; font-weight: 700; }

    /* Support */
    .support-btn { display: flex; align-items: center; justify-content: center; gap: 8px; width: 100%; max-width: 200px; padding: 12px; margin-top: 10px; border-radius: 12px; background: var(--bg-main); color: var(--text-main); text-decoration: none; font-weight: 600; border: 1px solid var(--border-color); transition: 0.3s; }
    .support-btn:hover { background: var(--accent); color: #000; border-color: var(--accent); transform: scale(1.02); }

    /* Responsive */
    @media (max-width: 900px) {
        .stat-divider { display: none; }
        .dash-header-glass { flex-direction: column; text-align: center; gap: 20px; }
        .action-grid { grid-template-columns: 1fr 1fr; }
        .dash-row { flex-direction: column; }
    }

    @media (max-width: 600px) {
        .action-grid { grid-template-columns: 1fr; }
        .modern-table th:nth-child(2), .modern-table td:nth-child(2) { display: none; }
    }
</style>