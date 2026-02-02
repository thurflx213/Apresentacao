<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios - Dashboard</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        }

        .header h1 {
            font-size: 2.5em;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 1.1em;
            opacity: 0.9;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px 40px 20px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: linear-gradient(135deg, #2a2a2a 0%, #3a3a3a 100%);
            padding: 25px;
            border-radius: 12px;
            border-left: 5px solid #ffd700;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(255, 215, 0, 0.2);
        }

        .stat-card h3 {
            font-size: 0.95em;
            color: #b0b0b0;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .stat-value {
            font-size: 2.5em;
            font-weight: bold;
            color: #ffd700;
            margin-bottom: 10px;
        }

        .stat-icon {
            font-size: 3em;
            opacity: 0.3;
            margin-top: 15px;
        }

        .charts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .chart-container {
            background: linear-gradient(135deg, #2a2a2a 0%, #3a3a3a 100%);
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
            border-top: 3px solid #ffd700;
        }

        .chart-container h3 {
            color: #ffd700;
            margin-bottom: 20px;
            font-size: 1.3em;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .chart-wrapper {
            position: relative;
            height: 300px;
            margin-bottom: 20px;
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 40px;
        }

        .action-button {
            background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
            color: #1a1a1a;
            border: none;
            padding: 15px 25px;
            border-radius: 8px;
            font-size: 1em;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
        }

        .action-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(255, 215, 0, 0.4);
        }

        .action-button:active {
            transform: translateY(-1px);
        }

        .footer-text {
            text-align: center;
            color: #888;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #444;
            font-size: 0.9em;
        }

        @media (max-width: 768px) {
            .header {
                padding: 15px 20px;
            }

            .header h1 {
                font-size: 1.8em;
            }

            .charts-grid {
                grid-template-columns: 1fr;
            }

            .stat-card {
                padding: 20px;
            }

            .stat-value {
                font-size: 2em;
            }
        }

        /* Animação de entrada */
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

        .stat-card, .chart-container {
            animation: slideIn 0.5s ease-out;
        }

        .stat-card:nth-child(1) { animation-delay: 0.1s; }
        .stat-card:nth-child(2) { animation-delay: 0.2s; }
        .stat-card:nth-child(3) { animation-delay: 0.3s; }
        .stat-card:nth-child(4) { animation-delay: 0.4s; }
    </style>
</head>
<body>
    <div class="header">
        <h1>📊 Relatórios do Sistema</h1>
        <p>Bem-vindo, <?php echo htmlspecialchars($nomeUsuario ?? 'Admin'); ?>! Visualize aqui todos os dados e análises do seu negócio.</p>
    </div>

    <div class="container">
        <!-- Estatísticas Principais -->
        <div class="stats-grid">
            <div class="stat-card">
                <h3>💰 Vendas Totais</h3>
                <div class="stat-value">R$ <?php echo number_format($vendastotais ?? 0, 2, ',', '.'); ?></div>
                <div class="stat-icon">📈</div>
            </div>

            <div class="stat-card">
                <h3>📦 Total de Produtos</h3>
                <div class="stat-value"><?php echo $produtostotais ?? 0; ?></div>
                <div class="stat-icon">🛍️</div>
            </div>

            <div class="stat-card">
                <h3>👥 Total de Clientes</h3>
                <div class="stat-value"><?php echo $clientestotais ?? 0; ?></div>
                <div class="stat-icon">👤</div>
            </div>

            <div class="stat-card">
                <h3>📋 Total de Pedidos</h3>
                <div class="stat-value"><?php echo $pedidostotais ?? 0; ?></div>
                <div class="stat-icon">🎁</div>
            </div>
        </div>

        <!-- Gráficos Principais -->
        <div class="charts-grid">
            <div class="chart-container">
                <h3>📈 Vendas por Mês (últimos 12 meses)</h3>
                <div class="chart-wrapper">
                    <canvas id="vendasPorMesChart"></canvas>
                </div>
            </div>

            <div class="chart-container">
                <h3>🏆 Top 8 Produtos Mais Vendidos</h3>
                <div class="chart-wrapper">
                    <canvas id="produtosMaisVendidosChart"></canvas>
                </div>
            </div>

            <div class="chart-container">
                <h3>📊 Status dos Pedidos</h3>
                <div class="chart-wrapper">
                    <canvas id="statusPedidosChart"></canvas>
                </div>
            </div>

            <div class="chart-container">
                <h3>🏪 Produtos por Categoria</h3>
                <div class="chart-wrapper">
                    <canvas id="categoriasChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Ações Rápidas -->
        <div class="actions-grid">
            <a href="/backend/relatorios/detalhado" class="action-button">📋 Relatório Detalhado de Pedidos</a>
            <a href="/backend/relatorios/financeiro" class="action-button">💵 Relatório Financeiro</a>
            <a href="/backend/relatorios/produtos" class="action-button">📦 Análise de Produtos</a>
            <a href="/backend/admin/dashboard" class="action-button">← Voltar ao Dashboard</a>
        </div>

        <div class="footer-text">
            <p>© 2025 Koketsu Store. Todos os dados são atualizados automaticamente.</p>
        </div>
    </div>

    <script>
        // Configuração global dos gráficos
        Chart.defaults.color = '#b0b0b0';
        Chart.defaults.borderColor = '#444';
        Chart.defaults.font.family = "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif";

        const chartColors = {
            primary: '#ffd700',
            secondary: '#ff6b6b',
            tertiary: '#4ecdc4',
            quaternary: '#45b7d1',
            quinary: '#96ceb4',
            senary: '#ffeaa7'
        };

        // Gráfico de Vendas por Mês
        const vendasPorMesData = <?php echo $vendasPorMes; ?>;
        const ctxVendas = document.getElementById('vendasPorMesChart').getContext('2d');
        new Chart(ctxVendas, {
            type: 'line',
            data: {
                labels: vendasPorMesData.labels,
                datasets: [{
                    label: 'Vendas (R$)',
                    data: vendasPorMesData.data,
                    borderColor: chartColors.primary,
                    backgroundColor: 'rgba(255, 215, 0, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 5,
                    pointBackgroundColor: chartColors.primary,
                    pointBorderColor: '#2a2a2a',
                    pointBorderWidth: 2,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: { size: 12, weight: 'bold' }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(255, 215, 0, 0.1)' }
                    }
                }
            }
        });

        // Gráfico de Produtos Mais Vendidos
        const produtosData = <?php echo $produtosMaisVendidos; ?>;
        const ctxProdutos = document.getElementById('produtosMaisVendidosChart').getContext('2d');
        new Chart(ctxProdutos, {
            type: 'bar',
            data: {
                labels: produtosData.labels,
                datasets: [{
                    label: 'Quantidade Vendida',
                    data: produtosData.data,
                    backgroundColor: [
                        chartColors.primary,
                        chartColors.secondary,
                        chartColors.tertiary,
                        chartColors.quaternary,
                        chartColors.quinary,
                        chartColors.senary,
                        'rgba(255, 193, 7, 0.8)',
                        'rgba(244, 67, 54, 0.8)'
                    ],
                    borderColor: '#1a1a1a',
                    borderWidth: 2,
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                indexAxis: 'y',
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        grid: { color: 'rgba(255, 215, 0, 0.1)' }
                    }
                }
            }
        });

        // Gráfico de Status de Pedidos
        const statusData = <?php echo $statusPedidos; ?>;
        const ctxStatus = document.getElementById('statusPedidosChart').getContext('2d');
        new Chart(ctxStatus, {
            type: 'doughnut',
            data: {
                labels: statusData.labels,
                datasets: [{
                    data: statusData.data,
                    backgroundColor: [
                        chartColors.primary,
                        chartColors.secondary,
                        chartColors.tertiary,
                        chartColors.quaternary,
                        chartColors.quinary
                    ],
                    borderColor: '#2a2a2a',
                    borderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 15,
                            font: { size: 12, weight: 'bold' }
                        }
                    }
                }
            }
        });

        // Gráfico de Categorias
        const categoriasData = <?php echo $categoriasMaisProdutos; ?>;
        const ctxCategorias = document.getElementById('categoriasChart').getContext('2d');
        new Chart(ctxCategorias, {
            type: 'radar',
            data: {
                labels: categoriasData.labels,
                datasets: [{
                    label: 'Quantidade de Produtos',
                    data: categoriasData.data,
                    borderColor: chartColors.primary,
                    backgroundColor: 'rgba(255, 215, 0, 0.15)',
                    borderWidth: 3,
                    pointRadius: 5,
                    pointBackgroundColor: chartColors.primary,
                    pointBorderColor: '#2a2a2a',
                    pointBorderWidth: 2,
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            padding: 15,
                            font: { size: 12, weight: 'bold' }
                        }
                    }
                },
                scales: {
                    r: {
                        beginAtZero: true,
                        grid: { color: 'rgba(255, 215, 0, 0.1)' },
                        ticks: { color: '#b0b0b0' }
                    }
                }
            }
        });
    </script>
</body>
</html>
