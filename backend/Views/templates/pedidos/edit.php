<div>Sou o edit</div>
<form action="/backend/pedido/atualizar/<?php echo $pedidos['id_pedido']; ?>" method="post">
    <label for="id_cliente">Cliente:</label>
    <input type="number" id="id_cliente" value="<?php echo $pedidos['id_pedido']; ?>" name="id_cliente" required>
    <br>

    <label for="data_pedido">Data do Pedido:</label>
    <input type="date" id="data_pedido" name="data_pedido"  value="<?php echo $pedidos['data_pedido']; ?>"  required>
    <br>

    <label for="total_pedido">Total do Pedido (R$):</label>
    <input type="number" step="0.01" id="total_pedido" value="<?php echo $pedidos['total_pedido']; ?>" name="total_pedido" required>
    <br>

    <label for="status_pedido">Status:</label>
    <select id="status_pedido" value="<?php echo $pedidos['status_pedido']; ?>" name="status_pedido" required>
        <option value="pendente">Pendente</option>
        <option value="pago">Pago</option>
        <option value="cancelado">Cancelado</option>
    </select>
    <br>

    <button type="submit">Salvar Pedido</button>
</form>