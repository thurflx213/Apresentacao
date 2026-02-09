<div class="dashboard-container w3-animate-opacity">
    <div class="dashboard-card">
        <h3 class="title">
            <i class="fa fa-dashboard"></i> Meu Painel
        </h3>

        <h1 class="welcome">
            Bem-vindo de volta, <?= htmlspecialchars($nomeUsuario); ?>!
        </h1>

        <h2 class="user-type">
            Seu usuário: <span><?= htmlspecialchars($Tipo); ?></span>
        </h2>

        <p class="subtitle">Esta é a sua área segura.</p>

        <div class="action-buttons">
            <a href="/backend/relatorios" class="action-btn relatorios">
                <i class="fa fa-bar-chart"></i> 
                <span>Visualizar Relatórios</span>
            </a>
            <a href="/backend/logout" class="action-btn logout">
                <i class="fa fa-sign-out"></i> 
                <span>Sair do Sistema</span>
            </a>
        </div>
    </div>
</div>
<style>
    .dashboard-container {
    display: flex;
    justify-content: center;
    padding: 40px;
    background-color: var(--bg-main) !important;
    min-height: 100vh;
}

.dashboard-card {
    background: var(--bg-card);
    padding: 40px;
    border-radius: 20px;
    width: 80%;
    max-width: 900px;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-color);
}

.dashboard-card .title {
    font-size: 26px;
    margin-bottom: 30px;
    color: var(--accent);
    font-weight: 800;
}

.dashboard-card .welcome {
    font-size: 32px;
    font-weight: bold;
    color: var(--text-main);
    margin: 10px 0;
}

.dashboard-card .user-type {
    font-size: 22px;
    color: var(--text-muted);
    margin-bottom: 15px;
}

.dashboard-card .user-type span {
    color: #28a745; 
    font-weight: 800;
    text-transform: uppercase;
}

.dashboard-card .subtitle {
    color: var(--text-muted);
    font-size: 16px;
    margin-bottom: 40px;
}

.action-buttons {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.action-btn {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    padding: 16px 32px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: bold;
    transition: all 0.3s ease;
}

.action-btn i {
    font-size: 18px;
}

.action-btn span {
    font-size: 16px;
}

.action-btn.relatorios {
    background: var(--accent);
    color: #000;
    box-shadow: 0 4px 15px rgba(197, 160, 45, 0.2);
}

.action-btn.relatorios:hover {
    background: var(--text-main);
    color: var(--bg-main);
    transform: translateY(-3px);
    box-shadow: var(--shadow-md);
}

.action-btn.logout {
    background: rgba(230, 57, 70, 0.12);
    color: #e63946;
    border: 1px solid rgba(230, 57, 70, 0.3);
}

.action-btn.logout:hover {
    background: #e63946;
    color: #fff;
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(230, 57, 70, 0.2);
}

.action-btn:active {
    transform: translateY(-1px);
}

@media (max-width: 768px) {
    .dashboard-container {
        padding: 20px;
    }

    .dashboard-card {
        width: 100%;
        padding: 20px;
    }

    .dashboard-card .welcome {
        font-size: 24px;
    }

    .dashboard-card .user-type {
        font-size: 18px;
    }

    .action-buttons {
        flex-direction: column;
    }

    .action-btn {
        justify-content: center;
        width: 100%;
    }
}

</style>