<div>Cadastro de Pedido</div>
<form action="/backend/pedido/salvar" method="post">
    
    <label for="id_cliente">Cliente (ID):</label>
    <input type="number" id="id_cliente" name="id_cliente" required>
    <br>

    <label for="data_pedido">Data do Pedido:</label>
    <input type="date" id="data_pedido" name="data_pedido" required>
    <br>

    <label for="total_pedido">Total do Pedido (R$):</label>
    <input type="number" step="0.01" id="total_pedido" name="total_pedido" required>
    <br>

    <label for="status_pedido">Status:</label>
    <select id="status_pedido" name="status_pedido" required>
        <option value="pendente">Pendente</option>
        <option value="pago">Pago</option>
        <option value="cancelado">Cancelado</option>
    </select>
    <br>

    <hr>
    
    <label for="id_produto">Produto (ID):</label>
    <input type="number" id="id_produto" name="id_produto" required>
    <br>

    <label for="quantidade">Quantidade:</label>
    <input type="number" id="quantidade" name="quantidade" value="1" required>
    <br>

    <button type="submit">Salvar Pedido</button>
</form>