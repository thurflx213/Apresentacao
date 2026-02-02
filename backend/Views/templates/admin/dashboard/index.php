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
}

.dashboard-card {
    background: #111;
    padding: 40px;
    border-radius: 16px;
    width: 80%;
    max-width: 900px;
    box-shadow: 0 0 20px rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.dashboard-card .title {
    font-size: 26px;
    margin-bottom: 30px;
    color: #f2f2f2;
}

.dashboard-card .welcome {
    font-size: 32px;
    font-weight: bold;
    color: #fff;
    margin: 10px 0;
}

.dashboard-card .user-type {
    font-size: 22px;
    color: #ddd;
    margin-bottom: 15px;
}

.dashboard-card .user-type span {
    color: #00d85a; /* verde bonito */
    font-weight: bold;
}

.dashboard-card .subtitle {
    color: #bbb;
    font-size: 16px;
    margin-bottom: 30px;
}

.action-buttons {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.action-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 28px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.action-btn i {
    font-size: 18px;
}

.action-btn span {
    font-size: 16px;
}

.action-btn.relatorios {
    background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
    color: #1a1a1a;
    box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
}

.action-btn.relatorios:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(255, 215, 0, 0.4);
}

.action-btn.logout {
    background: linear-gradient(135deg, #e63946 0%, #f44336 100%);
    color: #fff;
    box-shadow: 0 4px 15px rgba(230, 57, 70, 0.3);
}

.action-btn.logout:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(230, 57, 70, 0.4);
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