<div>
    <h1>Criar Movimentação de Estoque</h1>
    <form action="/backend/estoque/movimentacao/criar" method="POST">
        <div>
            <label for="id_produto">Produto:</label>
            <select name="id_produto" id="id_produto" required>
                <option value="">Selecione um produto</option>
                <?php foreach ($produtos as $produto): ?>
                    <option value="<?= $produto['id_produto'] ?>"><?= $produto['nome_produto'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="quantidade">Quantidade:</label>
            <input type="number" name="quantidade" id="quantidade" min="1" required>
        </div>
        <div>
            <label for="tipo_movimentacao">Tipo de Movimentação:</label>
            <select name="tipo_movimentacao" id="tipo_movimentacao" required>
                <option value="">Selecione</option>
                <option value="entrada">Entrada</option>
                <option value="saida">Saída</option>
            </select>
        </div>
        <button type="submit">Criar Movimentação</button>
    </form>
</div>
