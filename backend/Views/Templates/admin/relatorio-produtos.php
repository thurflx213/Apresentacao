<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Análise de Produtos</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            color: #e0e0e0;
            min-height: 100vh;
        }

        .header {
            background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
            color: #1a1a1a;
            padding: 20px 40px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 2em;
        }

        .header a {
            background: #1a1a1a;
            color: #ffd700;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .header a:hover {
            background: #2a2a2a;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px 40px 20px;
        }

        .table-container {
            background: linear-gradient(135deg, #2a2a2a 0%, #3a3a3a 100%);
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
            overflow: hidden;
            border-top: 3px solid #ffd700;
            margin-bottom: 40px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th {
            background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
            color: #1a1a1a;
            padding: 15px;
            font-weight: 600;
            text-align: left;
            text-transform: uppercase;
            font-size: 0.9em;
            letter-spacing: 1px;
            cursor: pointer;
            user-select: none;
        }

        table th:hover {
            background: linear-gradient(135deg, #ffed4e 0%, #ffd700 100%);
        }

        table td {
            padding: 15px;
            border-bottom: 1px solid #444;
        }

        table tbody tr {
            transition: background-color 0.2s ease;
        }

        table tbody tr:hover {
            background-color: rgba(255, 215, 0, 0.05);
        }

        table tbody tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.02);
        }

        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85em;
            font-weight: 600;
        }

        .badge-gold {
            background-color: rgba(255, 215, 0, 0.2);
            color: #ffd700;
            border: 1px solid #ffd700;
        }

        .badge-hot {
            background-color: rgba(255, 107, 107, 0.2);
            color: #ff6b6b;
            border: 1px solid #ff6b6b;
        }

        .badge-cold {
            background-color: rgba(78, 205, 196, 0.2);
            color: #4ecdc4;
            border: 1px solid #4ecdc4;
        }

        .valor {
            font-weight: 600;
            color: #ffd700;
        }

        .categoria {
            color: #96ceb4;
            font-weight: 500;
        }

        .info-box {
            background: linear-gradient(135deg, #2a2a2a 0%, #3a3a3a 100%);
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            border-left: 4px solid #ffd700;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
        }

        .info-box p {
            margin: 10px 0;
        }

        .info-box strong {
            color: #ffd700;
        }

        .search-box {
            background: linear-gradient(135deg, #2a2a2a 0%, #3a3a3a 100%);
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
        }

        .search-box input {
            width: 100%;
            padding: 12px 15px;
            background: #1a1a1a;
            border: 2px solid #444;
            color: #e0e0e0;
            border-radius: 6px;
            font-size: 1em;
            transition: border-color 0.3s ease;
        }

        .search-box input:focus {
            outline: none;
            border-color: #ffd700;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background: #444;
            border-radius: 4px;
            overflow: hidden;
            margin-top: 5px;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #ffd700, #ffed4e);
            transition: width 0.3s ease;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            table {
                font-size: 0.9em;
            }

            table th, table td {
                padding: 10px;
            }

            .header h1 {
                font-size: 1.5em;
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .table-container, .search-box, .info-box {
            animation: slideIn 0.5s ease-out;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>📦 Análise de Produtos</h1>
        <a href="/backend/relatorios">← Voltar</a>
    </div>

    <div class="container">
        <div class="info-box">
            <p><strong>Total de Produtos Analisados:</strong> <?php echo count($produtosMaisVendidos ?? []); ?></p>
            <p><strong>Data da Geração:</strong> <?php echo date('d/m/Y H:i:s'); ?></p>
        </div>

        <div class="search-box">
            <input type="text" id="searchInput" placeholder="🔍 Busque por nome do produto ou categoria...">
        </div>

        <div class="table-container">
            <table id="produtosTable">
                <thead>
                    <tr>
                        <th onclick="sortTable(0)">Código</th>
                        <th onclick="sortTable(1)">Produto</th>
                        <th onclick="sortTable(2)">Categoria</th>
                        <th onclick="sortTable(3)">Preço Unitário</th>
                        <th onclick="sortTable(4)">Quantidade Vendida</th>
                        <th onclick="sortTable(5)">Total Vendido</th>
                        <th onclick="sortTable(6)">Receita Gerada</th>
                        <th>Performance</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($produtosMaisVendidos)): ?>
                        <?php 
                        $totalReceita = array_sum(array_column($produtosMaisVendidos, 'receita'));
                        $maxQuantidade = max(array_column($produtosMaisVendidos, 'quantidade_total'));
                        ?>
                        <?php foreach ($produtosMaisVendidos as $index => $produto): ?>
                            <tr>
                                <td><strong>#<?php echo $produto['id_produto']; ?></strong></td>
                                <td><?php echo htmlspecialchars(substr($produto['nome_produtos'], 0, 50)); ?></td>
                                <td>
                                    <span class="categoria">
                                        <?php echo htmlspecialchars($produto['nome_categorias'] ?? 'Sem categoria'); ?>
                                    </span>
                                </td>
                                <td class="valor">R$ <?php echo number_format($produto['preco_produtos'] ?? 0, 2, ',', '.'); ?></td>
                                <td>
                                    <strong><?php echo $produto['total_vendido'] ?? 0; ?> vezes</strong>
                                </td>
                                <td>
                                    <strong><?php echo $produto['quantidade_total'] ?? 0; ?> unidades</strong>
                                </td>
                                <td class="valor">
                                    R$ <?php echo number_format($produto['receita'] ?? 0, 2, ',', '.'); ?>
                                </td>
                                <td>
                                    <?php
                                    $percentual = ($maxQuantidade > 0) ? (($produto['quantidade_total'] ?? 0) / $maxQuantidade * 100) : 0;
                                    $badgeClass = 'badge-cold';
                                    $badgeText = '❄️ Baixa';
                                    
                                    if ($percentual >= 70) {
                                        $badgeClass = 'badge-hot';
                                        $badgeText = '🔥 Hot';
                                    } elseif ($percentual >= 40) {
                                        $badgeClass = 'badge-gold';
                                        $badgeText = '⭐ Popular';
                                    }
                                    ?>
                                    <span class="badge <?php echo $badgeClass; ?>">
                                        <?php echo $badgeText; ?>
                                    </span>
                                    <div class="progress-bar">
                                        <div class="progress-fill" style="width: <?php echo $percentual; ?>%;"></div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" style="text-align: center; padding: 30px;">
                                <strong>Nenhum produto encontrado</strong>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div style="text-align: center; margin-top: 40px; color: #888;">
            <p>© 2025 Koketsu Store. Relatório Confidencial.</p>
        </div>
    </div>

    <script>
        // Função de busca em tempo real
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('#produtosTable tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });

        // Função de ordenação
        function sortTable(columnIndex) {
            const table = document.getElementById('produtosTable');
            const rows = Array.from(table.querySelectorAll('tbody tr'));
            const isAscending = table.dataset.sortColumn === columnIndex && table.dataset.sortOrder === 'asc';
            
            rows.sort((a, b) => {
                const aVal = a.cells[columnIndex].textContent.trim();
                const bVal = b.cells[columnIndex].textContent.trim();
                
                // Tenta converter para número
                const aNum = parseFloat(aVal.replace(/[^\d.-]/g, ''));
                const bNum = parseFloat(bVal.replace(/[^\d.-]/g, ''));
                
                if (!isNaN(aNum) && !isNaN(bNum)) {
                    return isAscending ? bNum - aNum : aNum - bNum;
                }
                
                return isAscending ? bVal.localeCompare(aVal) : aVal.localeCompare(bVal);
            });
            
            const tbody = table.querySelector('tbody');
            rows.forEach(row => tbody.appendChild(row));
            
            table.dataset.sortColumn = columnIndex;
            table.dataset.sortOrder = isAscending ? 'desc' : 'asc';
        }
    </script>
</body>
</html>