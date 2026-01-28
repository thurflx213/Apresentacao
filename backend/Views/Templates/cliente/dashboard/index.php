<div class="dashboard-container w3-animate-opacity">
    <div class="w3-container w3-margin-top">
        <h2 class="w3-text-yellow w3-xlarge">
            <i class="fa fa-user-circle"></i> Bem-vindo, <?= htmlspecialchars($nomeUsuario ?? 'Cliente') ?>!
        </h2>
        
        <hr class="w3-border-yellow">

        <div class="w3-row-padding w3-margin-top">
            <!-- Card Editar Perfil -->
            <div class="w3-col m4 w3-margin-bottom">
                <div class="w3-card-4 w3-padding-large dashboard-card">
                    <div class="w3-center">
                        <i class="fa fa-user-edit w3-xxlarge w3-text-yellow"></i>
                        <h4>Editar Perfil</h4>
                        <p>Atualize seus dados pessoais, foto e senha</p>
                        <a href="/backend/cliente/editar/<?= htmlspecialchars($usuarioId ?? '0') ?>" class="w3-button w3-yellow w3-text-black w3-round-large w3-block">
                            <i class="fa fa-edit"></i> Editar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card Meus Pedidos -->
            <div class="w3-col m4 w3-margin-bottom">
                <div class="w3-card-4 w3-padding-large dashboard-card">
                    <div class="w3-center">
                        <i class="fa fa-shopping-cart w3-xxlarge w3-text-yellow"></i>
                        <h4>Meus Pedidos</h4>
                        <p>Acompanhe seus pedidos</p>
                        <a href="/backend/pedidos" class="w3-button w3-yellow w3-text-black w3-round-large w3-block">
                            <i class="fa fa-list"></i> Ver Pedidos
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card Configurações -->
            <div class="w3-col m4 w3-margin-bottom">
                <div class="w3-card-4 w3-padding-large dashboard-card">
                    <div class="w3-center">
                        <i class="fa fa-cog w3-xxlarge w3-text-yellow"></i>
                        <h4>Configurações</h4>
                        <p>Gerencie suas preferências</p>
                        <a href="#" class="w3-button w3-yellow w3-text-black w3-round-large w3-block">
                            <i class="fa fa-sliders"></i> Configurar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="w3-container w3-margin-top w3-margin-bottom">
    <a href="/backend/logout" class="logout-btn">
        <i class="fa fa-sign-out"></i> Sair do Sistema
    </a>
</div>

<style>
    .dashboard-container {
        background-color: #1e1e1e;
        color: #f0f0f0;
        padding: 20px;
        border-radius: 8px;
    }

    .dashboard-card {
        background-color: #2a2a2a !important;
        color: #f0f0f0;
        border: 2px solid #333;
        transition: 0.3s;
    }

    .dashboard-card:hover {
        border-color: #ffcc00;
        box-shadow: 0 0 15px rgba(255, 204, 0, 0.3);
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

    .w3-text-yellow {
        color: #ffcc00 !important;
    }
</style>