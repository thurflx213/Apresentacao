<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    /* --- AJUSTES GERAIS --- */
    .page-wrapper {
        padding: 20px;
        width: 100%;
        box-sizing: border-box;
        background-color: #0c0c0c;
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .page-title {
        font-size: 28px;
        font-weight: 800;
        color: #ffffff;
        text-transform: uppercase;
        margin-bottom: 5px;
    }

    .header-breadcrumb {
        color: #888;
        margin-bottom: 25px;
        border-bottom: 1px solid #222;
        padding-bottom: 10px;
    }

    /* --- CARD DO GRÁFICO --- */
    .chart-container-card {
        background: #111;
        border: 1px solid #333;
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 35px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }

    /* --- BARRA DE PESQUISA --- */
    .actions-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 30px;
    }

    .search-group {
        flex: 1;
        max-width: 500px;
    }

    .search-input {
        width: 100%;
        background: #1a1a1a;
        border: 1px solid #444;
        padding: 15px;
        border-radius: 12px;
        color: #fff;
        font-size: 16px;
        transition: 0.3s;
    }

    .search-input:focus {
        border-color: #f2cc7d;
        box-shadow: 0 0 10px rgba(242, 204, 125, 0.1);
        outline: none;
    }

    .btn-main-action {
        background: #f2cc7d;
        color: #000 !important;
        padding: 15px 25px;
        border-radius: 12px;
        font-weight: 800;
        text-decoration: none;
        text-transform: uppercase;
        font-size: 14px;
        transition: 0.3s;
    }

    .btn-main-action:hover { background: #fff; transform: translateY(-2px); }

    /* --- TABELA --- */
    .custom-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 15px;
    }

    .custom-table thead th {
        color: #666;
        text-transform: uppercase;
        font-size: 13px;
        padding: 10px 20px;
    }

    .custom-table tbody tr {
        background: #161616;
        transition: 0.3s;
    }

    .custom-table td {
        padding: 20px !important;
        color: #ccc;
        font-size: 16px;
        vertical-align: middle;
    }

    .custom-table td:first-child { border-radius: 15px 0 0 15px; }
    .custom-table td:last-child { border-radius: 0 15px 15px 0; }

    .prod-img {
        width: 110px;
        height: 110px;
        object-fit: cover;
        border-radius: 12px;
        border: 2px solid #333;
    }

    .prod-name {
        font-weight: 700;
        color: #fff;
        font-size: 18px;
        display: block;
    }

    .badge-status {
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 800;
    }
    .status-ativo { background: rgba(40, 167, 69, 0.15); color: #28a745; border: 1px solid #28a745; }
    .status-inativo { background: rgba(220, 53, 69, 0.15); color: #dc3545; border: 1px solid #dc3545; }

    .btn-edit { background: #2196F3; color: #fff; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 700; }
    .btn-delete { background: #f44336; color: #fff; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 700; }
</style>

<div class="page-wrapper">
    <h3 class="page-title"><i class="fa fa-cubes" style="color: #f2cc7d;"></i> Gerenciar Produtos</h3>
    <header class="header-breadcrumb">
        <h5><b><i class="fa fa-dashboard"></i> Painel de produtos - Koketsu</b></h5>
    </header>

    <div class="chart-container-card">
        <h4 style="color: #f2cc7d; margin-top: 0; font-weight: 700;"><i class="fa fa-bar-chart"></i> Estoque por Categoria</h4>
        <div style="height: 350px;">
            <canvas id="vendasChart"></canvas>
        </div>
    </div>

    <div class="actions-bar">
        <div class="search-group">
            <input type="text" id="inputBusca" class="search-input" placeholder="Digite o nome do produto para filtrar...">
        </div>

        <a href="/backend/produtos/criar" class="btn-main-action">
            <i class="fa fa-plus-circle"></i> Adicionar Novo Produto
        </a>
    </div>

    <main>
        <table class="custom-table" id="tabelaProdutos">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Informações do Produto</th>
                    <th>Descrição Curta</th>
                    <th style="text-align: center;">Status</th>
                    <th style="text-align: center;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos as $p): 
                    $is_inativo = !empty($p['excluido_em']); 
                ?>
                <tr class="item-produto <?= $is_inativo ? 'tr-inativo' : '' ?>"> 
                    <td width="150">
                        <img src="/backend/upload/<?= htmlspecialchars($p['imagem_produtos']); ?>" class="prod-img" onerror="this.src='https://placehold.co/150x150?text=Sem+Foto'">
                    </td>
                    <td>
                        <span class="prod-name nome-produto"><?= htmlspecialchars($p['nome_produtos']); ?></span>
                        <small style="color: #666;">ID: #<?= $p['id_produto'] ?></small>
                    </td>
                    <td style="max-width: 350px; line-height: 1.5; color: #aaa;">
                        <?= htmlspecialchars($p['descricao_produtos']); ?>
                    </td>
                    <td style="text-align: center;">
                        <span class="badge-status <?= $is_inativo ? 'status-inativo' : 'status-ativo' ?>">
                            <?= $is_inativo ? 'Inativo' : 'Ativo' ?>
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <div style="display: flex; gap: 10px; justify-content: center;">
                            <a href="/backend/produtos/editar/<?= $p['id_produto']; ?>" class="btn-edit">Editar</a>
                            <?php if ($is_inativo): ?>
                                <a href="/backend/produtos/ativar/<?= $p['id_produto'] ?>" class="btn-edit" style="background: #4CAF50;">Ativar</a>
                            <?php else: ?>
                                <a href="/backend/produtos/excluir/<?= $p['id_produto'] ?>" class="btn-delete">Inativar</a>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</div>

<script>
    // --- LÓGICA DE FILTRO EM TEMPO REAL ---
    document.getElementById('inputBusca').addEventListener('keyup', function() {
        let busca = this.value.toLowerCase();
        let linhas = document.querySelectorAll('.item-produto');

        linhas.forEach(linha => {
            let nomeProduto = linha.querySelector('.nome-produto').textContent.toLowerCase();
            if (nomeProduto.includes(busca)) {
                linha.style.display = ""; // Mostra se bater com a busca ou se estiver vazio
            } else {
                linha.style.display = "none"; // Esconde se não bater
            }
        });
    });

    // --- GRÁFICO ---
    const dadosGrafico = <?php echo json_encode($produto); ?>; 
    if (dadosGrafico && dadosGrafico.length > 0) {
        new Chart(document.getElementById('vendasChart'), {
            type: 'bar',
            data: {
                labels: dadosGrafico.map(item => item.produto),
                datasets: [{
                    label: 'Estoque',
                    data: dadosGrafico.map(item => item.total),
                    backgroundColor: '#f2cc7d',
                    borderRadius: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { ticks: { color: '#888' } },
                    y: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#888' } }
                }
            }
        });
    }
</script>