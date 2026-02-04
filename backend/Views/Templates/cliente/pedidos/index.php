<?php
$usuarioId = $_SESSION['usuario_id'] ?? 0;
$nomeUsuario = $_SESSION['usuario_nome'] ?? 'Cliente';
?>
<div class="pedidos-container">
    <header class="pedidos-header">
        <a href="/backend/cliente/dashboard" class="back-btn"><i class="fa fa-arrow-left"></i> Voltar</a>
        <h1><i class="fa fa-shopping-bag"></i> Meus Pedidos</h1>
        <div></div>
    </header>

    <div id="debugInfo" style="display: none; background: rgba(255,215,0,0.1); padding: 10px; border-radius: 8px; margin-bottom: 20px; color: #ffd700; font-size: 12px; border: 1px solid #ffd700;">
        Debug: usuarioId = <span id="debugUserId"></span>, Carregando...
    </div>

    <div class="pedidos-content" id="pedidosContent">
        <div class="loading">
            <div class="spinner"></div>
            <p>Carregando seus pedidos...</p>
        </div>
    </div>
</div>

<style>
    :root {
        --bg: #0f0f10;
        --card: #1f1f23;
        --muted: #a8a9ad;
        --accent: #ffd700;
        --accent-2: #ffed4e;
        --success: #06d6a0;
        --warning: #f77f00;
        --danger: #e63946;
    }

    .pedidos-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .pedidos-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 18px 22px;
        background: linear-gradient(180deg, var(--card), #2b2b2b);
        border-radius: 10px;
        border-top: 4px solid var(--accent);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.6);
        margin-bottom: 30px;
    }

    .back-btn {
        color: var(--accent);
        text-decoration: none;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 14px;
        border-radius: 8px;
        transition: background .2s ease;
    }

    .back-btn:hover {
        background: rgba(255, 215, 0, 0.1);
    }

    .pedidos-header h1 {
        margin: 0;
        color: #fff;
        font-size: 24px;
    }

    .pedidos-content {
        display: grid;
        gap: 20px;
    }

    .loading {
        text-align: center;
        padding: 60px 20px;
        color: var(--muted);
    }

    .spinner {
        width: 40px;
        height: 40px;
        border: 4px solid rgba(255, 215, 0, 0.2);
        border-top: 4px solid var(--accent);
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
        margin: 0 auto 20px;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .pedido-card {
        background: linear-gradient(180deg, #232326, #1b1b1d);
        border: 1px solid rgba(255, 255, 255, 0.03);
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.5);
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .pedido-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.7);
    }

    .pedido-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
        padding-bottom: 16px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .pedido-numero {
        font-weight: 700;
        color: var(--accent);
        font-size: 16px;
    }

    .pedido-data {
        color: var(--muted);
        font-size: 14px;
        margin-top: 4px;
    }

    .pedido-status {
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-pendente {
        background: rgba(247, 127, 0, 0.2);
        color: var(--warning);
    }

    .status-processando {
        background: rgba(255, 215, 0, 0.2);
        color: var(--accent);
    }

    .status-enviado {
        background: rgba(6, 214, 160, 0.2);
        color: var(--success);
    }

    .status-entregue {
        background: rgba(6, 214, 160, 0.2);
        color: var(--success);
    }

    .status-cancelado {
        background: rgba(230, 57, 70, 0.2);
        color: var(--danger);
    }

    .status-pago {
        background: rgba(6, 214, 160, 0.2);
        color: var(--success);
    }

    .pedido-body {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 16px;
    }

    .pedido-info {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .info-row {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--muted);
        font-size: 14px;
    }

    .info-row strong {
        color: #fff;
        min-width: 100px;
    }

    .pedido-total {
        text-align: right;
        padding: 12px;
        background: rgba(255, 215, 0, 0.05);
        border-radius: 8px;
        border-left: 3px solid var(--accent);
    }

    .total-label {
        color: var(--muted);
        font-size: 12px;
        text-transform: uppercase;
    }

    .total-valor {
        color: var(--accent);
        font-size: 24px;
        font-weight: 700;
    }

    .pedido-footer {
        display: flex;
        gap: 10px;
        padding-top: 16px;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
    }

    .btn-detalhes {
        flex: 1;
        padding: 10px;
        background: rgba(255, 215, 0, 0.1);
        color: var(--accent);
        border: 1px solid var(--accent);
        border-radius: 8px;
        text-decoration: none;
        text-align: center;
        font-weight: 700;
        transition: all .2s ease;
        cursor: pointer;
        font-size: 14px;
    }

    .btn-detalhes:hover {
        background: rgba(255, 215, 0, 0.2);
        transform: translateY(-2px);
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: var(--muted);
    }

    .empty-icon {
        font-size: 48px;
        margin-bottom: 16px;
    }

    .empty-state h2 {
        color: #fff;
        margin: 0 0 8px 0;
    }

    .empty-state p {
        margin: 0 0 20px 0;
    }

    .continue-shopping {
        display: inline-block;
        background: linear-gradient(180deg, var(--accent), var(--accent-2));
        color: #111;
        padding: 12px 24px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 700;
        transition: transform .2s ease;
    }

    .continue-shopping:hover {
        transform: scale(1.05);
    }

    .error-state {
        text-align: center;
        padding: 60px 20px;
        color: var(--danger);
    }

    @media (max-width: 768px) {
        .pedidos-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .pedido-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .pedido-body {
            grid-template-columns: 1fr;
        }

        .pedido-total {
            text-align: left;
        }

        .total-valor {
            font-size: 20px;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    carregarPedidos();
});

function carregarPedidos() {
    const usuarioId = <?= $usuarioId ?>;
    
    // Mostrar debug
    document.getElementById('debugUserId').textContent = usuarioId;
    document.getElementById('debugInfo').style.display = 'block';
    
    console.log('Carregando pedidos para usuário ID:', usuarioId);
    
    // Se não tem ID de usuário, mostra vazio
    if (!usuarioId || usuarioId === 0) {
        console.warn('Usuário não autenticado');
        mostrarVazio();
        return;
    }
    
    // Carrega pedidos da API de forma simples
    fetch(`/backend/api/pedidos?page=1`)
        .then(response => {
            console.log('Resposta HTTP:', response.status);
            if (!response.ok) {
                throw new Error(`Erro HTTP: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log('Dados recebidos da API:', data);
            
            if (data.status === 'success' && data.data) {
                exibirPedidos(data.data, usuarioId);
            } else {
                throw new Error(data.message || 'Erro ao carregar pedidos');
            }
        })
        .catch(error => {
            console.error('Erro completo:', error);
            exibirErro();
        });
}

function exibirPedidos(pedidos, usuarioId) {
    const container = document.getElementById('pedidosContent');
    
    console.log('Dados de pedidos recebidos:', pedidos);
    console.log('ID do usuário:', usuarioId);
    
    if (!pedidos || !Array.isArray(pedidos) || pedidos.length === 0) {
        console.log('Nenhum pedido na resposta');
        mostrarVazio();
        return;
    }
    
    // Filtra pedidos do usuário
    const pedidosUsuario = pedidos.filter(p => {
        const idUsuariosDoPedido = parseInt(p.id_usuarios);
        console.log(`Comparando: pedido ${p.id_pedido} com id_usuarios=${idUsuariosDoPedido} vs usuarioId=${usuarioId}`);
        return idUsuariosDoPedido === usuarioId;
    });
    
    console.log('Pedidos após filtro:', pedidosUsuario);
    
    if (pedidosUsuario.length === 0) {
        console.log('Nenhum pedido encontrado para este usuário');
        mostrarVazio();
    } else {
        const html = pedidosUsuario
            .sort((a, b) => new Date(b.data_pedido) - new Date(a.data_pedido))
            .map(pedido => criarCartaoPedido(pedido))
            .join('');
        container.innerHTML = html;
    }
}

function criarCartaoPedido(pedido) {
    const statusClass = `status-${pedido.status_pedido?.toLowerCase() || 'pendente'}`;
    const statusLabel = {
        'pendente': 'Pendente',
        'processando': 'Processando',
        'enviado': 'Enviado',
        'entregue': 'Entregue',
        'cancelado': 'Cancelado',
        'pago': 'Pago'
    }[pedido.status_pedido?.toLowerCase()] || pedido.status_pedido;
    
    const data = new Date(pedido.data_pedido).toLocaleDateString('pt-BR');
    const hora = new Date(pedido.data_pedido).toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit' });
    const total = parseFloat(pedido.total_pedido || 0).toLocaleString('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    });

    return `
        <div class="pedido-card">
            <div class="pedido-header">
                <div>
                    <div class="pedido-numero">Pedido #${pedido.id_pedido}</div>
                    <div class="pedido-data">${data} às ${hora}</div>
                </div>
                <span class="pedido-status ${statusClass}">${statusLabel}</span>
            </div>
            
            <div class="pedido-body">
                <div class="pedido-info">
                    <div class="info-row">
                        <strong>ID:</strong>
                        <span>${pedido.id_pedido}</span>
                    </div>
                    <div class="info-row">
                        <strong>Status:</strong>
                        <span>${statusLabel}</span>
                    </div>
                </div>
                
                <div class="pedido-total">
                    <div class="total-label">Total</div>
                    <div class="total-valor">${total}</div>
                </div>
            </div>

            <div class="pedido-footer">
                <a href="/backend/cliente/pedidos/detalhes/${pedido.id_pedido}" class="btn-detalhes">Ver Detalhes</a>
            </div>
        </div>
    `;
}

function mostrarVazio() {
    document.getElementById('pedidosContent').innerHTML = `
        <div class="empty-state">
            <div class="empty-icon">📦</div>
            <h2>Nenhum pedido encontrado</h2>
            <p>Você ainda não fez nenhum pedido. Comece a comprar agora!</p>
            <a href="/" class="continue-shopping">Continuar Comprando</a>
        </div>
    `;
}

function exibirErro() {
    document.getElementById('pedidosContent').innerHTML = `
        <div class="error-state">
            <div class="empty-icon">⚠️</div>
            <h2>Erro ao carregar pedidos</h2>
            <p>Tivemos um problema ao carregar seus pedidos. Tente novamente mais tarde.</p>
        </div>
    `;
}
</script>
