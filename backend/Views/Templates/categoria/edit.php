<div>Sou o edit</div>
<form action="/backend/categoria/atualizar/<?php echo $categoria['id_categorias']; ?>" method="post" 
   enctype="multipart/form-data">
   <label for="nome">Nome:</label>
   <input type="text" id="nome_categorias" name="nome_categorias" value="<?php echo $categoria['nome_categorias'];?>" required> 
   <br>
   <label for="descricao">Descrição:</label>
   <textarea id="descricao_categorias" name="descricao_categorias"><?php echo $categoria['descricao_categorias']; ?></textarea>
   <br>
     <button type="submit">Salvar</button>
   </form>