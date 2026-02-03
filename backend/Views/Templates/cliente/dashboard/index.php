<div class="client-dashboard">
    <header class="dash-header">
        <div>
            <h2>👋 Bem-vindo, <span class="username"><?= htmlspecialchars($nomeUsuario ?? 'Cliente') ?></span>!</h2>
            <p class="muted">Acesse rapidamente suas principais ações</p>
        </div>
        <div>
            <a href="/backend/logout" class="logout-btn"><i class="fa fa-sign-out"></i> Sair</a>
        </div>
    </header>

    <section class="cards-grid">
        <a href="/backend/cliente/editar/<?= htmlspecialchars($usuarioId ?? '0') ?>" class="card card-action">
            <div class="card-icon"><i class="fa fa-user-circle"></i></div>
            <div class="card-body">
                <h3>Editar Perfil</h3>
                <p class="muted">Atualize seus dados pessoais, foto e senha</p>
            </div>
            <div class="card-cta">Editar <i class="fa fa-arrow-right"></i></div>
        </a>

        <a href="/backend/pedidos" class="card card-action">
            <div class="card-icon"><i class="fa fa-shopping-cart"></i></div>
            <div class="card-body">
                <h3>Meus Pedidos</h3>
                <p class="muted">Acompanhe o status de suas compras</p>
            </div>
            <div class="card-cta">Ver Pedidos <i class="fa fa-arrow-right"></i></div>
        </a>

        <a href="#" class="card card-action">
            <div class="card-icon"><i class="fa fa-cog"></i></div>
            <div class="card-body">
                <h3>Configurações</h3>
                <p class="muted">Gerencie suas preferências</p>
            </div>
            <div class="card-cta">Configurar <i class="fa fa-arrow-right"></i></div>
        </a>
    </section>
</div>

<style>
    :root{
        --bg:#0f0f10;
        --card:#1f1f23;
        --muted:#a8a9ad;
        --accent:#ffd700;
        --accent-2:#ffed4e;
        --glass: rgba(255,255,255,0.03);
    }

    .client-dashboard{max-width:1200px;margin:24px auto;padding:20px;}

    .dash-header{display:flex;align-items:center;justify-content:space-between;padding:18px 22px;background:linear-gradient(180deg,var(--card),#2b2b2b);border-radius:10px;border-top:4px solid var(--accent);box-shadow:0 12px 30px rgba(0,0,0,0.6);}
    .dash-header h2{margin:0;color:#fff;font-size:20px}
    .dash-header .username{color:var(--accent);font-weight:700}
    .muted{color:var(--muted);margin:4px 0 0}

    .logout-btn{background:#e63946;color:#fff;padding:10px 14px;border-radius:8px;text-decoration:none;font-weight:700}

    .cards-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-top:20px}

    .card{display:flex;align-items:center;gap:18px;padding:22px;border-radius:12px;background:linear-gradient(180deg,#232326,#1b1b1d);box-shadow:0 8px 24px rgba(0,0,0,0.5);border:1px solid rgba(255,255,255,0.03);text-decoration:none;color:#fff;transition:transform .18s ease,box-shadow .18s ease}
    .card:hover{transform:translateY(-6px);box-shadow:0 18px 40px rgba(0,0,0,0.7);border-color:rgba(255,215,0,0.18)}

    .card-icon{width:64px;height:64px;border-radius:12px;background:linear-gradient(180deg,var(--accent),var(--accent-2));display:flex;align-items:center;justify-content:center;color:#111;font-size:26px}
    .card-body h3{margin:0;font-size:18px}
    .card-body p{margin:6px 0 0;color:var(--muted)}
    .card-cta{margin-left:auto;color:var(--muted);font-weight:700}

    @media(max-width:900px){.cards-grid{grid-template-columns:1fr 1fr}}
    @media(max-width:600px){.cards-grid{grid-template-columns:1fr}.dash-header{flex-direction:column;align-items:flex-start;gap:10px}}
</style>