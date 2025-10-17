<div>
    <h1>Criar Avaliação</h1>
    <form action="/backend/avaliacao/criar" method="POST">
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
            <label for="nota">Nota:</label>
            <input type="number" name="nota" id="nota" min="1" max="5" required>
        </div>
        <div>
            <label for="comentario">Comentário:</label>
            <textarea name="comentario" id="comentario" rows="4" required></textarea>
        </div>
        <button type="submit">Enviar Avaliação</button>
    </form>
</div>
