<div class="w3-container">
    <h3>Nova avaliação</h3>
    <form action="/avaliacao/salvar" method="POST" enctype="multipart/form-data" class="w3-container w3-card-4">

        <p>
        <label class="w3-text-blue"><b>Nome do Produto</b></label>
        <input class="w3-input w3-border" name="nome_produto" type="text" required>
        </p>
        
        <p>
        <label class="w3-text-blue"><b>Descrição Curta</b></label>
        <input class="w3-input w3-border" name="descricao_produto" type="text">
        </p>

        <p>
        <label class="w3-text-blue"><b>Foto Principal</b></label>
        <input class="w3-input w3-border" name="foto_produto" type="file" required>
        </p>

        <p>
        <button class="w3-button w3-blue">Salvar Produto</button>
        </p>

    </form>
</div>