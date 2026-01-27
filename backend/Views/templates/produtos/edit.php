<div class="page-wrapper">

    <h3 class="page-title"><i class="fa fa-pencil"></i> Editando Produto: <?= htmlspecialchars($produtos['nome_produtos']); ?></h3>

    <form action="/backend/produtos/atualizar" method="post" enctype="multipart/form-data" class="form-card">

        <input type="text" id="id_produto" name="id_produto" value="<?php echo $produtos['id_produto']; ?>" hidden>

        <div class="form-group">
            <label for="nome_produtos">Nome:</label>
            <input type="text" id="nome_produtos" name="nome_produtos" value="<?php echo $produtos['nome_produtos']; ?>" required>
        </div>

        <div class="form-group">
            <label for="descricao_produtos">Descrição:</label>
            <textarea id="descricao_produtos" name="descricao_produtos" rows="4" required><?php echo $produtos['descricao_produtos']; ?></textarea>
        </div>

        <div class="form-group">
            <label for="preco_produtos">Preço:</label>
            <input type="number" step="0.01" id="preco_produtos" name="preco_produtos" value="<?php echo $produtos['preco_produtos']; ?>" required>
        </div>

        <div class="form-group">
            <label for="estoque_produtos">Estoque:</label>
            <input type="number" id="estoque_produtos" name="estoque_produtos" value="<?php echo $produtos['estoque_produtos']; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="imagem_produtos">Substituir Foto:</label>
            <input type="file" id="imagem_produtos" name="imagem_produtos">
            <small class="text-note">Deixe em branco para manter a foto atual.</small>
        </div>

        <div class="form-group">
            <label for="id_categoria">ID da Categoria:</label>
            <input type="number" id="id_categoria" name="id_categoria" value="<?php echo $produtos['id_categoria']; ?>" required>
        </div>

        <button type="submit" class="btn-save" style="margin-bottom: 10px;">
            <i class="fa fa-save"></i> Salvar Alterações
        </button>
        
        <a href="/backend/produtos/listar" class="btn-cancelar">
            <i class="fa fa-times-circle"></i> Cancelar
        </a>

    </form>

</div>
<style>
/* ------------------------------------------------------------------------------------------------- */
/* O SEU CSS EXISTENTE FOI MANTIDO AQUI E ALGUNS PEQUENOS AJUSTES PARA O FORMULÁRIO DE PRODUTOS */
/* ------------------------------------------------------------------------------------------------- */
.page-wrapper {
    /* Ajustei o padding-left para o padrão de 270px se você estiver usando um menu lateral de 250px */
    padding-left: 10px; 
    padding-right: 220px;
    padding-top: 0px; 
    width: 100%;
    box-sizing: border-box;

    display: flex; 
    flex-direction: column;
}

.form-card {
    background: #111;
    padding: 25px;
    border-radius: 12px;
    width: 420px;
    margin-left: auto;
    margin-right: auto;
    
    box-shadow: 0 0 15px rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.08);
}

.page-title {
    font-size: 26px;
    font-weight: 600;
    margin-bottom: 15px;
    color: #ffffff;
    width: 420px; 
    margin-left: auto;
    margin-right: auto;
    text-align: left;
}

.form-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 16px;
}

.form-group label {
    margin-bottom: 6px;
    font-size: 15px;
    color: #ddd;
}

.form-group input,
.form-group select,
.form-group textarea { /* Adicionado textarea aqui */
    background: #1a1a1a;
    border: 1px solid #333;
    padding: 10px;
    border-radius: 6px;
    color: #fff;
    font-size: 15px;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus { /* Adicionado textarea aqui */
    border-color: #e2c93eff;
    outline: none;
}

/* Estilo para a nota de rodapé do campo de arquivo */
.text-note {
    font-size: 12px;
    color: #bbb;
    margin-top: 5px;
}

.btn-save {
    width: 100%;
    background: #dfd155ff;
    padding: 12px;
    color: #000000ff;
    border: none;
    font-size: 16px;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.2s;
}

.btn-save:hover {
    background: #e49e1cff;
    box-shadow: 0 0 10px rgba(241, 220, 25, 0.4);
}

.btn-cancelar {
    display: block; 
    width: 100%;
    text-align: center;
    background: #555; 
    padding: 12px;
    color: #fff;
    border: none;
    font-size: 16px;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.2s;
    text-decoration: none; 
}

.btn-cancelar:hover {
    background: #777;
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
}

</style>