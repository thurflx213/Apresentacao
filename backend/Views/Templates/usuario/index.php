<style>
    /* --- AJUSTES GERAIS DE LAYOUT --- */
    .page-wrapper {
        padding: 20px;
        width: 100%;
        box-sizing: border-box;
        background-color: #0c0c0c;
        min-height: 100vh;
    }

    .page-title {
        font-size: 26px;
        font-weight: 800;
        margin-bottom: 5px;
        color: #ffffff;
        text-transform: uppercase;
        letter-spacing: -1px;
    }

    .header-breadcrumb {
        color: #888;
        margin-bottom: 25px;
        padding-bottom: 10px;
        border-bottom: 1px solid #222;
    }

    /* --- DASHBOARD CARDS PREMIUM --- */
    .dashboard-grid {
        display: flex;
        gap: 20px;
        margin-bottom: 30px;
        flex-wrap: wrap;
    }

    .stat-card {
        flex: 1;
        min-width: 220px;
        background: #1a1a1a;
        border: 1px solid #333;
        border-radius: 15px;
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: 0.3s;
    }

    .stat-card:hover { border-color: #f2cc7d; transform: translateY(-5px); }

    .stat-icon {
        font-size: 30px;
        color: #f2cc7d;
        background: rgba(242, 204, 125, 0.1);
        width: 55px;
        height: 55px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
    }

    .stat-info h3 { margin: 0; font-size: 28px; color: #fff; font-weight: 800; }
    .stat-info p { margin: 0; color: #666; text-transform: uppercase; font-size: 11px; letter-spacing: 1px; font-weight: 700; }

    /* --- ÁREA DE AÇÕES (BOTÃO + PESQUISA) --- */
    .actions-bar {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        gap: 20px;
        margin-bottom: 25px;
        flex-wrap: wrap;
    }

    .btn-main-action {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background-color: #f2cc7d !important;
        color: #000 !important;
        padding: 14px 24px;
        border-radius: 10px;
        font-weight: 800;
        text-transform: uppercase;
        font-size: 13px;
        letter-spacing: 0.5px;
        text-decoration: none;
        transition: 0.3s;
        border: none;
        box-shadow: 0 4px 15px rgba(242, 204, 125, 0.2);
        white-space: nowrap;
    }

    .btn-main-action:hover { background-color: #ffffff !important; transform: scale(1.02); }

    /* Estilo da Barra de Pesquisa */
    .search-container {
        position: relative;
        flex: 1;
        max-width: 400px;
    }

    .search-container i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #f2cc7d;
    }

    .search-input {
        width: 100%;
        background: #1a1a1a;
        border: 1px solid #333;
        padding: 13px 15px 13px 45px;
        border-radius: 10px;
        color: #fff;
        font-size: 14px;
        transition: 0.3s;
        outline: none;
    }

    .search-input:focus {
        border-color: #f2cc7d;
        background: #222;
        box-shadow: 0 0 10px rgba(242, 204, 125, 0.1);
    }

    /* --- TABELA DE USUÁRIOS --- */
    .user-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 10px;
        color: #ddd;
    }

    .user-table thead th {
        color: #ffffff !important;
        text-transform: uppercase;
        font-size: 12px;
        padding: 15px;
        letter-spacing: 1.5px;
        font-weight: 800;
    }

    .user-table tbody tr {
        background: #161616;
        transition: 0.2s;
        box-shadow: 0 4px 6px rgba(0,0,0,0.2);
    }

    .user-table tbody tr:hover { background: #1f1f1f; }

    .user-table td { padding: 18px 15px !important; border: none; vertical-align: middle; }
    .user-table td:first-child { border-radius: 12px 0 0 12px; }
    .user-table td:last-child { border-radius: 0 12px 12px 0; }

    .id-column { font-family: monospace; color: #aaa !important; font-weight: bold; }
    .email-column { color: #bbb !important; }

    .badge-status { padding: 6px 14px; border-radius: 8px; font-size: 10px; font-weight: 900; text-transform: uppercase; }
    .badge-active { background: #d4edda; color: #155724; }
    .badge-inactive { background: #333; color: #888; }

    .btn-action-small { padding: 8px 14px; border-radius: 8px; font-size: 11px; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 5px; transition: 0.3s; margin: 0 2px; }
    .btn-edit { background: #222; color: #f2cc7d; border: 1px solid #f2cc7d; }
    .btn-edit:hover { background: #f2cc7d; color: #000; }
    .btn-toggle { background: transparent; border: 1px solid #444; color: #999; }
    .btn-toggle:hover { border-color: #ff4444; color: #ff4444; }

    .tr-inativo { opacity: 0.5; filter: grayscale(0.8); }
</style>

<div class="page-wrapper">
    <h3 class="page-title"><i class="fa fa-users" style="color: #f2cc7d;"></i> Gerenciar Usuários</h3>

    <header class="header-breadcrumb">
        <h5><b><i class="fa fa-dashboard"></i> Painel de Controle - Koketsu</b></h5>
    </header>

    <div class="dashboard-grid">
        <div class="stat-card" style="border-left: 4px solid #f2cc7d;">
            <div class="stat-info">
                <h3><?php echo $total_admin; ?></h3>
                <p>Admins</p>
            </div>
            <div class="stat-icon"><i class="fa fa-shield"></i></div>
        </div>
        
        <div class="stat-card" style="border-left: 4px solid #f2cc7d;">
            <div class="stat-info">
                <h3><?php echo $total_ativos; ?></h3>
                <p>Ativos</p>
            </div>
            <div class="stat-icon"><i class="fa fa-signal"></i></div>
        </div>

        <div class="stat-card" style="border-left: 4px solid #f2cc7d;">
            <div class="stat-info">
                <h3><?php echo $total_inativos; ?></h3>
                <p>Inativos</p>
            </div>
            <div class="stat-icon"><i class="fa fa-exclamation-triangle"></i></div>
        </div>

        <div class="stat-card" style="border-left: 4px solid #f2cc7d;">
            <div class="stat-info">
                <h3><?php echo $total_usuarios; ?></h3>
                <p>Total Geral</p>
            </div>
            <div class="stat-icon"><i class="fa fa-users"></i></div>
        </div>
    </div>

    <div class="actions-bar">
        <a href="/backend/usuario/criar" class="btn-main-action">
            <i class="fa fa-user-plus"></i> Adicionar Novo Usuário
        </a>

        <div class="search-container">
            <i class="fa fa-search"></i>
            <input type="text" id="userInput" onkeyup="filterUsers()" placeholder="Buscar usuário por nome..." class="search-input">
        </div>
    </div>

    <main>
        <table class="user-table" id="userTable">
            <thead>
                <tr>
                    <th style="width: 80px;">ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Nível</th>
                    <th style="text-align: center;">Status</th>
                    <th style="text-align: center;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                <?php $is_inativo = !empty($usuario['excluido_em']);?>
                
                <tr class="<?= $is_inativo ? 'tr-inativo' : '' ?>"> 
                    <td class="id-column">#<?= $usuario['id_usuarios'] ?></td>
                    <td class="user-name" style="font-weight: 700; color: #fff; font-size: 1.05em;">
                        <?= htmlspecialchars($usuario['nome_usuarios']) ?>
                    </td>
                    <td class="email-column"><?= htmlspecialchars($usuario['email_usuarios']) ?></td>
                    <td>
                        <span style="color: #f2cc7d; font-size: 12px; font-weight: 800;">
                            <i class="fa fa-circle" style="font-size: 8px;"></i> <?= strtoupper($usuario['nivel_acesso']) ?>
                        </span>
                    </td>
                    
                    <td style="text-align: center;">
                        <?php if ($is_inativo): ?>
                            <span class="badge-status badge-inactive">Inativo</span>
                        <?php else: ?>
                            <span class="badge-status badge-active">Ativo</span>
                        <?php endif; ?>
                    </td>
                    
                    <td style="text-align: center;">
                        <a href="/backend/usuario/editar/<?= $usuario['id_usuarios'] ?>" class="btn-action-small btn-edit">
                            <i class="fa fa-pencil"></i> Editar
                        </a>
                        
                        <?php if ($is_inativo): ?>
                            <a href="/backend/usuario/ativar/<?= $usuario['id_usuarios'] ?>" class="btn-action-small btn-toggle">
                                <i class="fa fa-check"></i> Ativar
                            </a>
                        <?php else: ?>
                            <a href="/backend/usuario/excluir/<?= $usuario['id_usuarios'] ?>" class="btn-action-small btn-toggle">
                                <i class="fa fa-power-off"></i> Inativar
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</div>

<div style="height: 60px;"></div>

<script>
function filterUsers() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("userInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("userTable");
    tr = table.getElementsByTagName("tr");

    for (i = 1; i < tr.length; i++) {
        td = tr[i].getElementsByClassName("user-name")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
</script>