<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório Detalhado de Pedidos</title>
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

        table tbody tr {
            transition: background-color 0.2s ease;
        }

        table tbody tr:hover {
            background-color: rgba(255, 215, 0, 0.05);
        }

        table tbody tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.02);
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85em;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-entregue {
            background-color: rgba(76, 175, 80, 0.2);
            color: #4caf50;
            border: 1px solid #4caf50;
        }

        .status-pendente {
            background-color: rgba(255, 193, 7, 0.2);
            color: #ffc107;
            border: 1px solid #ffc107;
        }

        .status-cancelado {
            background-color: rgba(244, 67, 54, 0.2);
            color: #f44336;
            border: 1px solid #f44336;
        }

        .status-processando {
            background-color: rgba(33, 150, 243, 0.2);
            color: #2196f3;
            border: 1px solid #2196f3;
        }

        .status-em-entrega {
            background-color: rgba(156, 39, 176, 0.2);
            color: #9c27b0;
            border: 1px solid #9c27b0;
        }

        .valor {
            font-weight: 600;
            color: #ffd700;
        }

        .pagination {
            margin-top: 30px;
            text-align: center;
        }

        .pagination a {
            background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
            color: #1a1a1a;
            padding: 10px 15px;
            margin: 0 5px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            transition: transform 0.2s ease;
        }

        .pagination a:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
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

        .table-container {
            animation: slideIn 0.5s ease-out;
        }

        .info-box {
            animation: slideIn 0.5s ease-out;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>📋 Relatório Detalhado de Pedidos</h1>
        <a href="/backend/relatorios">← Voltar</a>
    </div>

    <div class="container">
        <div class="info-box">
            <p><strong>Total de Pedidos:</strong> <?php echo count($pedidos ?? []); ?></p>
            <p><strong>Data da Geração:</strong> <?php echo date('d/m/Y H:i:s'); ?></p>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID Pedido</th>
                        <th>Data</th>
                        <th>Cliente</th>
                        <th>Email</th>
                        <th>Valor Total</th>
                        <th>Status</th>
                        <th>Itens</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pedidos)): ?>
                        <?php foreach ($pedidos as $pedido): ?>
                            <tr>
                                <td><strong>#<?php echo $pedido['id_pedido']; ?></strong></td>
                                <td><?php echo date('d/m/Y H:i', strtotime($pedido['data_pedido'])); ?></td>
                                <td><?php echo htmlspecialchars($pedido['nome_usuarios'] ?? 'Não informado'); ?></td>
                                <td><?php echo htmlspecialchars($pedido['email_usuarios'] ?? 'Não informado'); ?></td>
                                <td class="valor">R$ <?php echo number_format($pedido['total_pedido'] ?? 0, 2, ',', '.'); ?></td>
                                <td>
                                    <?php
                                    $status = $pedido['status_pedido'] ?? 'Desconhecido';
                                    $statusClass = 'status-pendente';
                                    
                                    switch(strtolower($status)) {
                                        case 'entregue':
                                            $statusClass = 'status-entregue';
                                            break;
                                        case 'em entrega':
                                            $statusClass = 'status-em-entrega';
                                            break;
                                        case 'cancelado':
                                            $statusClass = 'status-cancelado';
                                            break;
                                        case 'processando':
                                            $statusClass = 'status-processando';
                                            break;
                                    }
                                    ?>
                                    <span class="status-badge <?php echo $statusClass; ?>">
                                        <?php echo htmlspecialchars($status); ?>
                                    </span>
                                </td>
                                <td><?php echo $pedido['quantidade_itens'] ?? 0; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 30px;">
                                <strong>Nenhum pedido encontrado</strong>
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
</body>
</html>
