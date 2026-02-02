<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório Financeiro</title>
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

        .resumo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .resumo-card {
            background: linear-gradient(135deg, #2a2a2a 0%, #3a3a3a 100%);
            padding: 25px;
            border-radius: 12px;
            border-top: 4px solid #ffd700;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
            transition: transform 0.3s ease;
        }

        .resumo-card:hover {
            transform: translateY(-5px);
        }

        .resumo-card h3 {
            font-size: 0.95em;
            color: #b0b0b0;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .resumo-valor {
            font-size: 2.2em;
            font-weight: bold;
            color: #ffd700;
            margin-bottom: 10px;
        }

        .resumo-subtexto {
            font-size: 0.85em;
            color: #888;
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
        }

        table td {
            padding: 15px;
            border-bottom: 1px solid #444;
        }

        table tbody tr:hover {
            background-color: rgba(255, 215, 0, 0.05);
        }

        table tbody tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.02);
        }

        .valor-positivo {
            color: #4caf50;
            font-weight: 600;
        }

        .valor-destaque {
            color: #ffd700;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .charts-grid {
                grid-template-columns: 1fr;
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

        .resumo-card, .chart-container, .table-container {
            animation: slideIn 0.5s ease-out;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>💵 Relatório Financeiro</h1>
        <a href="/backend/relatorios">← Voltar</a>
    </div>

    <div class="container">
        <!-- Resumo Financeiro Principal -->
        <div class="resumo-grid">
            <div class="resumo-card">
                <h3>💰 Receita Total</h3>
                <div class="resumo-valor">R$ <?php echo number_format($resumoFinanceiro['receita_total'] ?? 0, 2, ',', '.'); ?></div>
                <div class="resumo-subtexto">Todas as vendas completadas</div>
            </div>

            <div class="resumo-card">
                <h3>📊 Total de Pedidos</h3>
                <div class="resumo-valor"><?php echo $resumoFinanceiro['total_pedidos'] ?? 0; ?></div>
                <div class="resumo-subtexto">Pedidos entregues/em entrega</div>
            </div>

            <div class="resumo-card">
                <h3>📈 Ticket Médio</h3>
                <div class="resumo-valor">R$ <?php echo number_format($resumoFinanceiro['ticket_medio'] ?? 0, 2, ',', '.'); ?></div>
                <div class="resumo-subtexto">Valor médio por pedido</div>
            </div>

            <div class="resumo-card">
                <h3>🎯 Menor Venda</h3>
                <div class="resumo-valor">R$ <?php echo number_format($resumoFinanceiro['menor_venda'] ?? 0, 2, ',', '.'); ?></div>
                <div class="resumo-subtexto">Menor valor de pedido</div>
            </div>

            <div class="resumo-card">
                <h3>🚀 Maior Venda</h3>
                <div class="resumo-valor">R$ <?php echo number_format($resumoFinanceiro['maior_venda'] ?? 0, 2, ',', '.'); ?></div>
                <div class="resumo-subtexto">Maior valor de pedido</div>
            </div>
        </div>

        <!-- Gráfico de Vendas por Mês -->
        <div class="charts-grid">
            <div class="chart-container">
                <h3>📈 Evolução de Vendas (últimos 12 meses)</h3>
                <div class="chart-wrapper">
                    <canvas id="vendasMesesChart"></canvas>
                </div>
            </div>

            <div class="chart-container">
                <h3>🏅 Top 5 Meses com Maior Receita</h3>
                <div class="chart-wrapper">
                    <canvas id="topMesesChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Tabela Detalhada de Vendas por Mês -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Mês</th>
                        <th>Quantidade de Pedidos</th>
                        <th>Valor Total</th>
                        <th>Ticket Médio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($vendasPorMes)): ?>
                        <?php foreach ($vendasPorMes as $mes): ?>
                            <tr>
                                <td><strong><?php echo $mes['mes']; ?></strong></td>
                                <td><?php echo $mes['quantidade']; ?></td>
                                <td class="valor-positivo">R$ <?php echo number_format($mes['valor'] ?? 0, 2, ',', '.'); ?></td>
                                <td class="valor-destaque">R$ <?php echo number_format(($mes['valor'] ?? 0) / ($mes['quantidade'] ?? 1), 2, ',', '.'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 30px;">
                                <strong>Nenhum dado disponível</strong>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div style="text-align: center; margin-top: 40px; color: #888;">
            <p><strong>Data da Geração:</strong> <?php echo date('d/m/Y H:i:s'); ?></p>
            <p>© 2025 Koketsu Store. Relatório Confidencial.</p>
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
            quaternary: '#45b7d1'
        };

        // Preparar dados
        const vendasMeses = <?php echo json_encode($vendasPorMes); ?>;
        const meses = [];
        const valores = [];
        const quantidades = [];

        vendasMeses.forEach(item => {
            meses.push(item.mes);
            valores.push(parseFloat(item.valor) || 0);
            quantidades.push(parseInt(item.quantidade) || 0);
        });

        // Gráfico de Vendas por Mês (Linha)
        const ctxVendas = document.getElementById('vendasMesesChart').getContext('2d');
        new Chart(ctxVendas, {
            type: 'line',
            data: {
                labels: meses,
                datasets: [{
                    label: 'Valor de Vendas (R$)',
                    data: valores,
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

        // Gráfico de Top 5 Meses (Barra)
        const top5Meses = meses.slice(-5);
        const top5Valores = valores.slice(-5);

        const ctxTop = document.getElementById('topMesesChart').getContext('2d');
        new Chart(ctxTop, {
            type: 'bar',
            data: {
                labels: top5Meses,
                datasets: [{
                    label: 'Receita (R$)',
                    data: top5Valores,
                    backgroundColor: [
                        'rgba(255, 215, 0, 0.8)',
                        'rgba(255, 193, 7, 0.8)',
                        'rgba(255, 171, 0, 0.8)',
                        'rgba(255, 152, 0, 0.8)',
                        'rgba(255, 109, 0, 0.8)'
                    ],
                    borderColor: '#1a1a1a',
                    borderWidth: 2,
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
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
    </script>
</body>
</html>