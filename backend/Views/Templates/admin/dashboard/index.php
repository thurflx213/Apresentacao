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

        <a href="/backend/logout" class="logout-btn">
            <i class="fa fa-sign-out"></i> Sair do Sistema
        </a>
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
    margin-bottom: 25px;
}

.logout-btn {
    display: inline-block;
    background: #e63946;
    padding: 12px 22px;
    color: #fff;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    transition: 0.2s;
}

.logout-btn:hover {
    background: #ff4d5b;
    box-shadow: 0 0 10px rgba(255, 80, 80, 0.4);
}

</style>