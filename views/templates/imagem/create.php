<div>
    <h1>Criar Imagem</h1>
    <form action="/backend/imagem/criar" method="POST" enctype="multipart/form-data">
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
            <label for="imagem">Imagem:</label>
            <input type="file" name="imagem" id="imagem" accept="image/*" required>
        </div>
        <button type="submit">Criar Imagem</button>
    </form>
</div>
