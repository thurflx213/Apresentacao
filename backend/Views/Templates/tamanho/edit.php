<div class="w3-container">
  <h5><b><i class="fa fa-dashboard"></i> Editar Tamanho: <?= htmlspecialchars($tamanho['id_tamanhos']) ?></b></h5>
  <form action="/backend/tamanho/atualizar" method="post"
   enctype="multipart/form-data" class="w3-container w3-card-4">
   <input type="text" id="id_tamanhos" name="id_tamanhos" value="<?php echo $tamanho['id_tamanhos']; ?>" hidden>
   <label for="id_produto">Produto:</label>
   <input type="text" id="id_produto" name="id_produto" value="<?php echo $tamanho['id_produto']; ?>" required>
   <br>
   <label for="tamanho_tamanhos">Tamanho:</label>
   <input type="text" id="tamanho_tamanhos" name="tamanho_tamanhos" value="<?php echo $tamanho['tamanho_tamanhos']; ?>" required>
   <br>
   <label for="quantidade_tamanhos">Quantidade:</label>
   <input type="number" id="quantidade_tamanhos" name="quantidade_tamanhos" value="<?php echo $tamanho['quantidade_tamanhos']; ?>" required>
   <br>
   <p>
        <button type="submit" class="w3-button w3-blue">Salvar Alterações</button>
        <a href="/backend/tamanho/listar" class="w3-button w3-grey">Cancelar</a>
        </p>
   </form
  ></form>
</div>
