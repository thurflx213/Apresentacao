<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    /* --- AJUSTES GERAIS --- */
    .page-wrapper {
        padding: 20px;
        width: 100%;
        box-sizing: border-box;
        background-color: var(--bg-main) !important;
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: var(--text-main);
    }

    .page-title {
        font-size: 28px;
        font-weight: 800;
        color: var(--text-main);
        text-transform: uppercase;
        margin-bottom: 5px;
    }

    .header-breadcrumb {
        color: var(--text-muted);
        margin-bottom: 25px;
        border-bottom: 1px solid var(--border-color);
        padding-bottom: 10px;
    }

    /* --- CARD DO GRÁFICO --- */
    .chart-container-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 35px;
        box-shadow: var(--shadow-md);
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
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        padding: 15px;
        border-radius: 12px;
        color: var(--text-main);
        font-size: 16px;
        transition: 0.3s;
        box-shadow: var(--shadow-sm);
    }

    .search-input:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(197, 160, 45, 0.1);
        outline: none;
    }

    .btn-main-action {
        background: var(--accent);
        color: #000 !important;
        padding: 15px 25px;
        border-radius: 12px;
        font-weight: 800;
        text-decoration: none;
        text-transform: uppercase;
        font-size: 14px;
        transition: 0.3s;
        box-shadow: var(--shadow-sm);
    }

    .btn-main-action:hover { background: var(--text-main); color: var(--bg-main) !important; transform: translateY(-2px); }

    /* --- TABELA --- */
    .custom-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 15px;
    }

    .custom-table thead th {
        color: var(--text-muted);
        text-transform: uppercase;
        font-size: 11px;
        padding: 10px 20px;
        font-weight: 800;
        letter-spacing: 1px;
    }

    .custom-table tbody tr {
        background: var(--bg-card);
        transition: all 0.3s ease;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-color);
    }

    .custom-table tbody tr:hover { 
        transform: scale(1.01);
        box-shadow: var(--shadow-md);
        border-color: var(--accent);
    }

    .custom-table td {
        padding: 20px !important;
        color: var(--text-main);
        font-size: 16px;
        vertical-align: middle;
        border-top: 1px solid var(--border-color);
        border-bottom: 1px solid var(--border-color);
    }

    .custom-table td:first-child { border-radius: 15px 0 0 15px; border-left: 1px solid var(--border-color); }
    .custom-table td:last-child { border-radius: 0 15px 15px 0; border-right: 1px solid var(--border-color); }

    .prod-img {
        width: 110px;
        height: 110px;
        object-fit: cover;
        border-radius: 12px;
        border: 2px solid var(--border-color);
        box-shadow: var(--shadow-sm);
    }

    .prod-name {
        font-weight: 700;
        color: var(--text-main);
        font-size: 18px;
        display: block;
    }

    .badge-status {
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
    }
    .status-ativo { background: rgba(40, 167, 69, 0.1); color: #28a745; border: 1px solid rgba(40, 167, 69, 0.3); }
    .status-inativo { background: rgba(220, 53, 69, 0.1); color: #dc3545; border: 1px solid rgba(220, 53, 69, 0.3); }

    .btn-edit { background: var(--bg-main); color: #2196F3; border: 1px solid #2196F3; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 700; transition: 0.3s; }
    .btn-edit:hover { background: #2196F3; color: #fff; }
    .btn-delete { background: var(--bg-main); color: #f44336; border: 1px solid #f44336; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 700; transition: 0.3s; }
    .btn-delete:hover { background: #f44336; color: #fff; }
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
        // Obter cores do CSS para o gráfico
        const style = getComputedStyle(document.body);
        const textColor = style.getPropertyValue('--text-muted').trim() || '#888';
        const gridColor = style.getPropertyValue('--border-color').trim() || 'rgba(0,0,0,0.1)';
        const accentColor = style.getPropertyValue('--accent').trim() || '#f2cc7d';

        new Chart(document.getElementById('vendasChart'), {
            type: 'bar',
            data: {
                labels: dadosGrafico.map(item => item.produto),
                datasets: [{
                    label: 'Estoque',
                    data: dadosGrafico.map(item => item.total),
                    backgroundColor: accentColor,
                    borderRadius: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { 
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: style.getPropertyValue('--bg-card').trim(),
                        titleColor: style.getPropertyValue('--text-main').trim(),
                        bodyColor: style.getPropertyValue('--text-main').trim(),
                        borderColor: style.getPropertyValue('--border-color').trim(),
                        borderWidth: 1
                    }
                },
                scales: {
                    x: { ticks: { color: textColor }, grid: { display: false } },
                    y: { 
                        beginAtZero: true, 
                        grid: { color: gridColor }, 
                        ticks: { color: textColor } 
                    }
                }
            }
        });
    }
</script>