<div class="w3-container w3-margin-top">
    <h2>Editar pedido</h2>

    <?php if (!empty($pedido) && isset($pedido['id_pedido'])): ?>
        <form action="/backend/pedido/atualizar/<?php echo (int)$pedido['id_pedido']; ?>" method="post" class="w3-container w3-card w3-padding w3-black">

            <label for="data_pedido">Data:</label>
            <input class="w3-input w3-margin-bottom" type="text" id="data_pedido" name="data_pedido"
                value="<?php echo htmlspecialchars($pedido['data_pedido'] ?? ''); ?>" required>

            <label for="total_pedido">Total:</label>
            <textarea class="w3-input w3-margin-bottom" id="total_pedido" name="total_pedido" required><?php echo htmlspecialchars($pedido['total_pedido'] ?? ''); ?></textarea>

            <label for="status_pedido">Status:</label>
            <input class="w3-input w3-margin-bottom" type="text"  id="status_pedido" name="status_pedido"
                value="<?php echo htmlspecialchars($pedido['status_pedido'] ?? ''); ?>" required>

            <label for="imagem_pedidos">Imagem (URL):</label>
            <input class="w3-input w3-margin-bottom" type="text" id="imagem_pedidos" name="imagem_pedidos"
                value="<?php echo htmlspecialchars($pedido['imagem_pedidos'] ?? ''); ?>">

            <label for="id_pedido">Pedido (ID):</label>
            <input class="w3-input w3-margin-bottom" type="number" id="id_pedido" name="id_pedido"
                value="<?php echo htmlspecialchars($pedido['id_pedido'] ?? ''); ?>" required>

            <button type="submit" class="w3-button w3-yellow w3-round-large">Salvar</button>
        </form>

    <?php else: ?>
        <div class="w3-panel w3-red w3-padding">
            <p><b>Erro:</b> pedido não encontrado.</p>
        </div>
    <?php endif; ?>
</div>
