<?php
$pedido = $dados['pedido'] ?? [];
?>

<style>
    /* Estilos base */
    .premium-card {
        background-color: #1a1a1a;
        border-radius: 30px;
        border: 1px solid #333;
        box-shadow: 0 20px 50px rgba(0,0,0,0.6);
        max-width: 800px;
        margin: 20px auto;
        padding: 40px;
        font-family: sans-serif;
    }

    .input-gold {
        background-color: #f2cc7d !important;
        color: #000 !important;
        font-weight: bold;
        border-radius: 12px;
        border: none;
        padding: 12px 15px;
        width: 100%;
    }

    /* Estilo especial para o input de arquivo */
    input[type="file"]::file-selector-button {
        background: #333;
        color: #f2cc7d;
        border: 1px solid #f2cc7d;
        padding: 8px 16px;
        border-radius: 8px;
        cursor: pointer;
        margin-right: 15px;
        transition: 0.3s;
    }

    input[type="file"]::file-selector-button:hover {
        background: #f2cc7d;
        color: #000;
    }

    .label-gray {
        color: #888;
        font-size: 14px;
        margin-bottom: 8px;
        display: block;
        font-weight: 500;
    }

    .btn-save {
        background: linear-gradient(180deg, #f2cc7d 0%, #d4a74a 100%);
        color: #000;
        font-weight: 900;
        border: none;
        padding: 18px;
        border-radius: 15px;
        width: 100%;
        max-width: 400px;
        cursor: pointer;
        text-transform: uppercase;
        letter-spacing: 2px;
        transition: 0.2s;
    }

    .grid-row { display: flex; gap: 30px; margin-bottom: 25px; }
    .grid-col { flex: 1; }

    .image-preview-box {
        background-color: #111;
        border: 1px solid #333;
        border-radius: 20px;
        padding: 20px;
        display: flex;
        gap: 20px;
        align-items: center;
        margin-top: 20px;
    }
</style>

<div class="premium-card">
    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 30px;">
        <div>
            <h1 style="font-size: 32px; margin: 0; color: white;">Editar Pedido <span style="color: #555;">#<?php echo $pedido['id_pedido'] ?? '2'; ?></span></h1>
            <a href="/backend/pedido/listar" style="color: #888; text-decoration: none; font-size: 14px; display: block; margin-top: 10px;">&larr; Voltar à lista</a>
        </div>
    </div>

    <form action="/backend/pedido/atualizar/<?php echo (int)$pedido['id_pedido']; ?>" method="POST" enctype="multipart/form-data">
        
        <div class="grid-row">
            <div class="grid-col">
                <label class="label-gray">Data e Hora</label>
                <input type="datetime-local" name="data_pedido" class="input-gold" 
                       value="<?php echo !empty($pedido['data_pedido']) ? date('Y-m-d\TH:i', strtotime($pedido['data_pedido'])) : ''; ?>">
            </div>
            <div class="grid-col">
                <label class="label-gray">Total (RS)</label>
                <div style="position: relative;">
                    <input type="number" step="0.01" name="total_pedido" class="input-gold" 
                           value="<?php echo $pedido['total_pedido'] ?? '0.00'; ?>">
                    <span style="position: absolute; right: 15px; top: 12px; color: rgba(0,0,0,0.4); font-weight: bold;">R$</span>
                </div>
            </div>
        </div>

        <div style="margin-bottom: 25px;">
            <label class="label-gray">Status do Pedido</label>
            <select name="status_pedido" style="background:#111; color:#ccc; border:1px solid #444; padding:12px; border-radius:12px; width:100%;">
                <?php 
                $statuses = ['pendente', 'pago', 'enviado', 'concluido', 'cancelado'];
                $current = $pedido['status_pedido'] ?? '';
                foreach ($statuses as $s): ?>
                    <option value="<?php echo $s; ?>" <?php echo ($current === $s) ? 'selected' : ''; ?>><?php echo ucfirst($s); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        </div>

        <input type="hidden" name="id_pedido" value="<?php echo $pedido['id_pedido']; ?>">

        <div style="text-align: center; margin-top: 40px;">
            <button type="submit" class="btn-save">SALVAR ALTERAÇÕES</button>
        </div>
    </form>
</div>