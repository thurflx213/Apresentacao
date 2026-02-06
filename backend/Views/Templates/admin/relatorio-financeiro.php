<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório Financeiro - Koketsu Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Reset e Base */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', 'Segoe UI', sans-serif; }
        
        :root {
            --bg-dark: #0a0a0a;
            --card-bg: #161616;
            --koketsu-gold: #ffcc00;
            --koketsu-gold-hover: #e6b800;
            --text-main: #e0e0e0;
            --text-muted: #888;
            --sidebar-width: 260px;
        }

        body { 
            background-color: var(--bg-dark); 
            color: var(--text-main); 
            display: flex; 
            min-height: 100vh; 
        }

        /* Sidebar Customizada */
        .sidebar {
            width: var(--sidebar-width);
            background-color: #111;
            padding: 30px 20px;
            border-right: 1px solid #222;
            flex-shrink: 0;
            position: sticky;
            top: 0;
            height: 100vh;
        }

        .profile-section { text-align: center; padding-bottom: 30px; border-bottom: 1px solid #222; margin-bottom: 20px; }
        .profile-img { width: 70px; height: 70px; border-radius: 50%; border: 2px solid var(--koketsu-gold); margin-bottom: 10px; object-fit: cover; }
        .profile-name { font-size: 0.85em; color: var(--text-muted); line-height: 1.4; }

        .menu-item { 
            padding: 14px 18px; 
            display: flex; 
            align-items: center; 
            color: #fff; 
            text-decoration: none; 
            border-radius: 8px;
            margin-bottom: 5px;
            transition: 0.2s;
            font-size: 0.95em;
        }
        .menu-item i { margin-right: 15px; width: 20px; font-size: 1.1em; color: var(--text-muted); }
        .menu-item:hover { background: #1a1a1a; color: var(--koketsu-gold); }
        .menu-item:hover i { color: var(--koketsu-gold); }
        .menu-item.active { background: rgba(255, 204, 0, 0.1); color: var(--koketsu-gold); font-weight: bold; }
        .menu-item.active i { color: var(--koketsu-gold); }

        /* Main Content */
        .main-content { flex-grow: 1; padding: 40px; overflow-y: auto; }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .header-title h1 { font-size: 1.8em; font-weight: 700; letter-spacing: -1px; }
        .header-title p { color: var(--text-muted); font-size: 0.9em; margin-top: 5px; }

        .btn-back {
            background: var(--koketsu-gold);
            color: #000;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.85em;
            transition: 0.3s;
            text-transform: uppercase;
        }
        .btn-back:hover { background: var(--koketsu-gold-hover); transform: translateX(-5px); }

        /* Status Cards */
        .resumo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .resumo-card {
            background: var(--card-bg);
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #222;
            transition: 0.3s;
            position: relative;
            overflow: hidden;
        }
        .resumo-card:hover { border-color: var(--koketsu-gold); transform: translateY(-5px); }
        .resumo-card i { position: absolute; right: 20px; top: 20px; font-size: 1.5em; color: rgba(255, 204, 0, 0.1); }
        .resumo-card h3 { font-size: 0.8em; text-transform: uppercase; color: var(--text-muted); letter-spacing: 1px; margin-bottom: 10px; }
        .resumo-valor { font-size: 1.8em; font-weight: 800; color: var(--koketsu-gold); }
        .resumo-sub { font-size: 0.75em; color: #555; margin-top: 5px; }

        /* Charts Section */
        .charts-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 40px;
        }

        .chart-container {
            background: var(--card-bg);
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #222;
        }
        .chart-container h3 { font-size: 1em; margin-bottom: 25px; color: var(--text-main); display: flex; align-items: center; }
        .chart-container h3 i { margin-right: 10px; color: var(--koketsu-gold); }

        /* Table Design */
        .table-container {
            background: var(--card-bg);
            border-radius: 12px;
            border: 1px solid #222;
            overflow: hidden;
        }

        table { width: 100%; border-collapse: collapse; }
        table th { background: #1a1a1a; color: var(--koketsu-gold); padding: 18px; text-align: left; font-size: 0.8em; text-transform: uppercase; }
        table td { padding: 18px; border-bottom: 1px solid #222; font-size: 0.9em; }
        table tr:last-child td { border-bottom: none; }
        table tr:hover { background: rgba(255, 255, 255, 0.02); }

        .valor-positivo { color: #00ff88; font-weight: 600; }
        .badge-mes { background: #222; padding: 4px 10px; border-radius: 4px; color: #fff; font-size: 0.85em; }

        @media (max-width: 1100px) { .charts-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>

    

    <main class="main-content">
        <header class="header-top">
            <div class="header-title">
                <h1>💵 Relatório Financeiro</h1>
                <p>Análise de saúde financeira e desempenho de vendas.</p>
            </div>
            <a href="/backend/relatorios" class="btn-back"><i class="fas fa-arrow-left"></i> Voltar</a>
        </header>

        <div class="resumo-grid">
            <div class="resumo-card">
                <i class="fas fa-hand-holding-usd"></i>
                <h3>Receita Total</h3>
                <div class="resumo-valor">R$ <?php echo number_format($resumoFinanceiro['receita_total'] ?? 0, 2, ',', '.'); ?></div>
                <div class="resumo-sub">Vendas confirmadas</div>
            </div>

            <div class="resumo-card">
                <i class="fas fa-box-open"></i>
                <h3>Pedidos</h3>
                <div class="resumo-valor"><?php echo $resumoFinanceiro['total_pedidos'] ?? 0; ?></div>
                <div class="resumo-sub">Volume total processado</div>
            </div>

            <div class="resumo-card">
                <i class="fas fa-chart-line"></i>
                <h3>Ticket Médio</h3>
                <div class="resumo-valor">R$ <?php echo number_format($resumoFinanceiro['ticket_medio'] ?? 0, 2, ',', '.'); ?></div>
                <div class="resumo-sub">Média por cliente</div>
            </div>

            <div class="resumo-card">
                <i class="fas fa-arrow-up"></i>
                <h3>Maior Venda</h3>
                <div class="resumo-valor">R$ <?php echo number_format($resumoFinanceiro['maior_venda'] ?? 0, 2, ',', '.'); ?></div>
                <div class="resumo-sub">Recorde de pedido único</div>
            </div>
        </div>

        <div class="charts-grid">
            <div class="chart-container">
                <h3><i class="fas fa-chart-area"></i> Evolução de Vendas</h3>
                <div style="height: 300px;">
                    <canvas id="vendasMesesChart"></canvas>
                </div>
            </div>

            <div class="chart-container">
                <h3><i class="fas fa-crown"></i> Top Meses (Receita)</h3>
                <div style="height: 300px;">
                    <canvas id="topMesesChart"></canvas>
                </div>
            </div>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Mês de Referência</th>
                        <th>Qtd. Pedidos</th>
                        <th>Receita Bruta</th>
                        <th>Ticket Médio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($vendasPorMesTabela)): ?>
                        <?php foreach ($vendasPorMesTabela as $mes): ?>
                            <tr>
                                <td><span class="badge-mes"><?php echo $mes['mes']; ?></span></td>
                                <td><?php echo $mes['quantidade']; ?> un.</td>
                                <td class="valor-positivo">R$ <?php echo number_format($mes['valor'] ?? 0, 2, ',', '.'); ?></td>
                                <td style="color: var(--koketsu-gold);">R$ <?php echo number_format(($mes['valor'] ?? 0) / ($mes['quantidade'] ?? 1), 2, ',', '.'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="4" style="text-align:center; padding: 40px; color: #444;">Nenhum dado financeiro registrado.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <footer style="margin-top: 50px; text-align: center; color: #444; font-size: 0.8em;">
            <p>Gerado em: <?php echo date('d/m/Y H:i'); ?> • Koketsu Store Dashboard v2.0</p>
        </footer>
    </main>

    <script>
        // Configurações do Chart.js para o tema Dark
        Chart.defaults.color = '#777';
        Chart.defaults.font.family = "'Inter', sans-serif";

        const vendasData = <?php echo json_encode($vendasPorMes); ?>;
        const labels = vendasData.map(d => d.mes);
        const valores = vendasData.map(d => d.valor);

        // Gráfico de Linha
        new Chart(document.getElementById('vendasMesesChart'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Vendas (R$)',
                    data: valores,
                    borderColor: '#ffcc00',
                    backgroundColor: 'rgba(255, 204, 0, 0.05)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 3,
                    pointRadius: 4,
                    pointBackgroundColor: '#ffcc00'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { grid: { color: '#222' }, border: { display: false } },
                    x: { grid: { display: false } }
                }
            }
        });

        // Gráfico de Barras
        new Chart(document.getElementById('topMesesChart'), {
            type: 'bar',
            data: {
                labels: labels.slice(-5),
                datasets: [{
                    data: valores.slice(-5),
                    backgroundColor: '#ffcc00',
                    borderRadius: 5,
                    barPercentage: 0.6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { grid: { color: '#222' }, border: { display: false } },
                    x: { grid: { display: false } }
                }
            }
        });
    </script>
</body>
</html>