<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Análise de Produtos | Koketsu</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-gold: #ffd700;
            --dark-bg: #121212;
            --card-bg: #1e1e1e;
            --text-gray: #b0b0b0;
        }

        body {
            font-family: 'Inter', 'Segoe UI', sans-serif;
            background-color: var(--dark-bg);
            color: #ffffff;
            margin: 0;
        }

        /* Header Estilo Koketsu */
        .header {
            background: #000;
            padding: 20px 5%;
            border-bottom: 2px solid var(--primary-gold);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header h1 {
            font-size: 1.5rem;
            margin: 0;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .btn-voltar {
            background: transparent;
            color: var(--primary-gold);
            border: 1px solid var(--primary-gold);
            padding: 8px 18px;
            border-radius: 4px;
            text-decoration: none;
            transition: 0.3s;
            font-size: 0.9rem;
        }

        .btn-voltar:hover {
            background: var(--primary-gold);
            color: #000;
        }

        .container {
            max-width: 1400px;
            margin: 30px auto;
            padding: 0 20px;
        }

        /* Dashboard Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--card-bg);
            padding: 20px;
            border-radius: 12px;
            border: 1px solid #333;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .stat-icon {
            background: rgba(255, 215, 0, 0.1);
            color: var(--primary-gold);
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-size: 1.5rem;
        }

        .stat-info span {
            display: block;
            color: var(--text-gray);
            font-size: 0.8rem;
            text-transform: uppercase;
        }

        .stat-info strong {
            font-size: 1.2rem;
            color: #fff;
        }

        /* Busca */
        .search-container {
            margin-bottom: 25px;
            position: relative;
        }

        .search-container input {
            width: 100%;
            background: var(--card-bg);
            border: 1px solid #333;
            padding: 15px 20px 15px 45px;
            border-radius: 8px;
            color: white;
            outline: none;
            transition: 0.3s;
        }

        .search-container input:focus {
            border-color: var(--primary-gold);
            box-shadow: 0 0 10px rgba(255, 215, 0, 0.1);
        }

        .search-container i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-gray);
        }

        /* Tabela Premium */
        .table-wrapper {
            background: var(--card-bg);
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            background: #252525;
            color: var(--primary-gold);
            text-align: left;
            padding: 18px;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            cursor: pointer;
        }

        tbody td {
            padding: 15px 18px;
            border-bottom: 1px solid #2a2a2a;
            font-size: 0.95rem;
        }

        tbody tr:hover {
            background: rgba(255, 255, 255, 0.02);
        }

        /* Estilos de Célula */
        .product-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .product-img {
            width: 40px;
            height: 40px;
            background: #333;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            color: var(--primary-gold);
            border: 1px solid #444;
        }

        .badge-status {
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 700;
        }

        .hot { background: rgba(255, 71, 87, 0.15); color: #ff4757; }
        .popular { background: rgba(255, 165, 2, 0.15); color: #ffa502; }
        .low { background: rgba(46, 213, 115, 0.15); color: #2ed573; }

        .progress-container {
            width: 100px;
            height: 6px;
            background: #333;
            border-radius: 10px;
            margin-top: 8px;
        }

        .progress-bar {
            height: 100%;
            border-radius: 10px;
            background: var(--primary-gold);
        }
    </style>
</head>
<body>

    <div class="header">
        <h1><i class="fas fa-chart-line"></i> Análise de Produtos</h1>
        <a href="/backend/relatorios" class="btn-voltar"><i class="fas fa-chevron-left"></i> Painel</a>
    </div>

    <div class="container">
        <?php 
            $totalProdutos = count($produtosMaisVendidos ?? []);
            $totalReceita = array_sum(array_column($produtosMaisVendidos ?? [], 'receita'));
            $maxQuantidade = $totalProdutos > 0 ? max(array_column($produtosMaisVendidos, 'quantidade_total')) : 0;
        ?>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-box"></i></div>
                <div class="stat-info">
                    <span>Itens Analisados</span>
                    <strong><?php echo $totalProdutos; ?> Produtos</strong>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-dollar-sign"></i></div>
                <div class="stat-info">
                    <span>Receita Total Acumulada</span>
                    <strong style="color: var(--primary-gold);">R$ <?php echo number_format($totalReceita, 2, ',', '.'); ?></strong>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-calendar-alt"></i></div>
                <div class="stat-info">
                    <span>Data do Relatório</span>
                    <strong><?php echo date('d/m/Y H:i'); ?></strong>
                </div>
            </div>
        </div>

        <div class="search-container">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="Filtrar por nome, categoria ou código...">
        </div>

        <div class="table-wrapper">
            <table id="produtosTable">
                <thead>
                    <tr>
                        <th onclick="sortTable(0)">Cód.</th>
                        <th onclick="sortTable(1)">Produto</th>
                        <th onclick="sortTable(2)">Categoria</th>
                        <th onclick="sortTable(3)">Preço</th>
                        <th onclick="sortTable(4)">Vendas</th>
                        <th onclick="sortTable(5)">Qtd Total</th>
                        <th onclick="sortTable(6)">Receita</th>
                        <th>Performance</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($produtosMaisVendidos)): ?>
                        <?php foreach ($produtosMaisVendidos as $produto): ?>
                            <?php 
                                $qtd = $produto['quantidade_total'] ?? 0;
                                // Nova lógica baseada em quantidade absoluta solicitada pelo usuário
                                if ($qtd > 40) {
                                    $statusClass = 'hot';
                                    $statusText = '🔥 ALTA';
                                } elseif ($qtd >= 15) {
                                    $statusClass = 'popular';
                                    $statusText = '⭐ MÉDIA';
                                } else {
                                    $statusClass = 'low';
                                    $statusText = '📉 BAIXA';
                                }
                                
                                // Mantém a barra de progresso baseada no máximo para visualização proporcional
                                $perc = ($maxQuantidade > 0) ? ($qtd / $maxQuantidade * 100) : 0;
                            ?>
                            <tr>
                                <td style="color: var(--text-gray);">#<?php echo $produto['id_produto']; ?></td>
                                <td>
                                    <div class="product-cell">
                                        <div class="product-img"><?php echo strtoupper(substr($produto['nome_produtos'], 0, 2)); ?></div>
                                        <span><?php echo htmlspecialchars($produto['nome_produtos']); ?></span>
                                    </div>
                                </td>
                                <td><span style="color: #96ceb4;"><?php echo $produto['nome_categorias'] ?? 'Geral'; ?></span></td>
                                <td>R$ <?php echo number_format($produto['preco_produtos'], 2, ',', '.'); ?></td>
                                <td><?php echo $produto['total_vendido']; ?>x</td>
                                <td><strong><?php echo $produto['quantidade_total']; ?></strong></td>
                                <td style="color: var(--primary-gold); font-weight: 600;">
                                    R$ <?php echo number_format($produto['receita'], 2, ',', '.'); ?>
                                </td>
                                <td>
                                    <span class="badge-status <?php echo $statusClass; ?>"><?php echo $statusText; ?></span>
                                    <div class="progress-container">
                                        <div class="progress-bar" style="width: <?php echo $perc; ?>%;"></div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Mesmo JS funcional que você já tinha, mas otimizado para o novo layout
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const val = this.value.toLowerCase();
            document.querySelectorAll('#produtosTable tbody tr').forEach(row => {
                row.style.display = row.innerText.toLowerCase().includes(val) ? '' : 'none';
            });
        });

        function sortTable(n) {
            const table = document.getElementById("produtosTable");
            let rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            switching = true;
            dir = "asc";
            while (switching) {
                switching = false;
                rows = table.rows;
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];
                    
                    let xVal = x.innerText.replace('R$', '').replace('.', '').replace(',', '.').trim();
                    let yVal = y.innerText.replace('R$', '').replace('.', '').replace(',', '.').trim();
                    
                    if (dir == "asc") {
                        if (isNaN(xVal) ? x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase() : parseFloat(xVal) > parseFloat(yVal)) {
                            shouldSwitch = true; break;
                        }
                    } else if (dir == "desc") {
                        if (isNaN(xVal) ? x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase() : parseFloat(xVal) < parseFloat(yVal)) {
                            shouldSwitch = true; break;
                        }
                    }
                }
                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    switchcount ++;
                } else {
                    if (switchcount == 0 && dir == "asc") { dir = "desc"; switching = true; }
                }
            }
        }
    </script>
</body>
</html>