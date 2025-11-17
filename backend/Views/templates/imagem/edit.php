<div class="w3-container">
    <h3>Editando Imagem: <?= htmlspecialchars($imagem['nome_imagem']); ?></h3>

    <form action="/backend/imagem/atualizar" method="POST" enctype="multipart/form-data" class="w3-container w3-card-4">

        <input type="hidden" name="id_imagem" value="<?= $imagem['id_imagem']; ?>">

        <p>
        <label class="w3-text-blue"><b>Nome da Imagem</b></label>
        <input class="w3-input w3-border" name="nome_imagem" type="text" value="<?= htmlspecialchars($imagem['nome_imagem']); ?>" required>
        </p>
        
        <p>
        <label class="w3-text-blue"><b>Descrição Curta</b></label>
        <input class="w3-input w3-border" name="descricao_imagem" type="text" value="<?= htmlspecialchars($imagem['descricao_imagem']); ?>">
        </p>

        <p>
            <label class="w3-text-blue"><b>Foto Principal (Atual)</b></label><br>
            <img src="/upload/imagens/<?= htmlspecialchars($imagem['foto_imagem']); ?>" style="width:150px; border: 1px solid #ccc; padding: 4px;">
        </p>

        <p>
        <label class="w3-text-blue"><b>Substituir Foto</b></label>
        <input class="w3-input w3-border" name="foto_imagem" type="file">
        <small>Deixe em branco para manter a foto atual.</small>
        </p>

        <p>
        <button type="submit" class="w3-button w3-blue">Salvar Alterações</button>
        <a href="/backend/imagem/listar" class="w3-button w3-grey">Cancelar</a>
        </p>

    </form>
</div>