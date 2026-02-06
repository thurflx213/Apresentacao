<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório Detalhado - Painel Koketsu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Estilos Base */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        
        body { 
            background-color: #000; 
            color: #fff; 
            display: flex; 
            min-height: 100vh; 
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #111;
            padding: 20px;
            border-right: 1px solid #333;
            flex-shrink: 0;
        }

        .profile-section { text-align: center; padding-bottom: 20px; border-bottom: 1px solid #333; }
        .profile-img { width: 80px; height: 80px; border-radius: 50%; border: 2px solid #ffd700; margin-bottom: 10px; }
        .profile-name { font-size: 0.9em; color: #ccc; }

        .menu-list { list-style: none; margin-top: 20px; }
        .menu-item { padding: 12px; transition: 0.3s; cursor: pointer; display: flex; align-items: center; color: #fff; text-decoration: none; }
        .menu-item:hover { background: #222; color: #ffd700; }
        .menu-item i { margin-right: 15px; width: 20px; }

        /* Conteúdo Principal */
        .main-content { flex-grow: 1; padding: 40px; background-color: #0a0a0a; }

        /* Header Amarelo Koketsu */
        .page-header {
            background: #ffcc00;
            color: #000;
            padding: 15px 30px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .btn-voltar {
            background: #111;
            color: #ffcc00;
            padding: 8px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            font-size: 0.8em;
            transition: 0.3s;
        }

        .btn-voltar:hover { background: #222; }

        /* Info Box */
        .info-card {
            background: #1a1a1a;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            border-left: 5px solid #ffcc00;
            color: #ccc;
        }
        .info-card strong { color: #ffcc00; }

        /* Tabela Estilizada */
        .table-wrapper {
            background: #1a1a1a;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }

        table { width: 100%; border-collapse: collapse; }
        
        table th {
            background-color: #ffcc00;
            color: #000;
            padding: 15px;
            text-align: left;
            text-transform: uppercase;
            font-size: 0.8em;
        }

        table td {
            padding: 15px;
            border-bottom: 1px solid #333;
            color: #ddd;
            font-size: 0.9em;
        }

        table tr:hover { background: #252525; }

        /* Badges de Status - CORRIGIDAS E COMPLETAS */
        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75em;
            font-weight: bold;
            text-transform: uppercase;
            display: inline-block;
            min-width: 90px;
            text-align: center;
        }

        /* Cores dos Status */
        .status-pendente  { color: #ffbb33; border: 1px solid #ffbb33; background: rgba(255, 187, 51, 0.1); }
        .status-pago      { color: #00C851; border: 1px solid #00C851; background: rgba(0, 200, 81, 0.1); }
        .status-enviado   { color: #33b5e5; border: 1px solid #33b5e5; background: rgba(51, 181, 229, 0.1); }
        .status-entregue  { color: #e6d119ff; border: 1px solid #e6d119ff; background: rgba(230, 209, 25, 0.1); }
        .status-concluido { color: #e025b8ff; border: 1px solid #e025b8ff; background: rgba(224, 37, 184, 0.1); }
        .status-cancelado { color: #ff4444; border: 1px solid #ff4444; background: rgba(255, 68, 68, 0.1); }
        /* Fallback para status desconhecido */
        .status-default   { color: #bbb; border: 1px solid #bbb; background: rgba(255, 255, 255, 0.1); }

        .price { color: #ffcc00; font-weight: bold; }
    </style>
</head>
<body>

 

    <main class="main-content">
        <div class="page-header">
            <h2><i class="fas fa-file-alt"></i> Relatório Detalhado de Pedidos</h2>
            <a href="/backend/relatorios" class="btn-voltar">← VOLTAR</a>
        </div>

        <div class="info-card">
            <p><strong>Total de Pedidos Encontrados:</strong> <?php echo count($pedidos ?? []); ?></p>
            <p><strong>Relatório gerado em:</strong> <?php echo date('d/m/Y H:i:s'); ?></p>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID Pedido</th>
                        <th>Data</th>
                        <th>Cliente</th>
                        <th>Email</th>
                        <th>Valor Total</th>
                        <th>Status</th>
                        <th>Qtd Itens</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pedidos)): ?>
                        <?php foreach ($pedidos as $pedido): ?>
                            <tr>
                                <td><strong>#<?php echo $pedido['id_pedido']; ?></strong></td>
                                <td><?php echo date('d/m/Y', strtotime($pedido['data_pedido'])); ?></td>
                                <td><?php echo htmlspecialchars($pedido['nome_usuarios'] ?? 'Não informado'); ?></td>
                                <td><?php echo htmlspecialchars($pedido['email_usuarios'] ?? '---'); ?></td>
                                <td class="price">R$ <?php echo number_format($pedido['total_pedido'] ?? 0, 2, ',', '.'); ?></td>
                                <td>
                                    <?php 
                                        // Normaliza o status para o CSS (minúsculo, sem espaços e sem acentos básicos)
                                        $status_original = $pedido['status_pedido'] ?? 'pendente';
                                        $status_formatado = strtolower(trim($status_original));
                                        
                                        // Mapeamento de nomes amigáveis para classes CSS
                                        $mapa_classes = [
                                            'pago' => 'status-pago',
                                            'concluido' => 'status-concluido',
                                            'concluído' => 'status-concluido',
                                            'enviado' => 'status-enviado',
                                            'entregue' => 'status-entregue',
                                            'cancelado' => 'status-cancelado',
                                            'pendente' => 'status-pendente'
                                        ];

                                        $classe_css = $mapa_classes[$status_formatado] ?? 'status-default';
                                    ?>
                                    <span class="badge <?php echo $classe_css; ?>">
                                        <?php echo htmlspecialchars($status_original); ?>
                                    </span>
                                </td>
                                <td style="text-align: center;"><?php echo $pedido['quantidade'] ?? 0; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 50px; color: #666;">
                                <i class="fas fa-search" style="font-size: 2em; margin-bottom: 10px; display: block;"></i>
                                Nenhum pedido encontrado na base de dados.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <footer style="margin-top: 30px; text-align: center; font-size: 0.8em; color: #444;">
            &copy; <?php echo date('Y'); ?> Koketsu Store - Gestão de Relatórios
        </footer>
    </main>

</body>
</html>