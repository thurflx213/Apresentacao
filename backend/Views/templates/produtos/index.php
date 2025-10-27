<header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> Painel de Controle - Koketsu</b></h5>
  </header>


<div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
      <div class="w3-container w3-theme w3-padding-16">
        <div class="w3-left"><i class="fa fa-tags w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>120</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Produtos</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-black w3-padding-16">
        <div class="w3-left"><i class="fa fa-shopping-cart w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>87</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Pedidos</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-yellow w3-text-black w3-padding-16">
        <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>56</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Clientes</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-dark-grey w3-padding-16">
        <div class="w3-left"><i class="fa fa-star w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>4.8★</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Avaliações</h4>
      </div>
    </div>
  </div>
 <div>Listar produtos</div>
<!-- listar usuario -->
<?php if (isset($produtos) && count($produtos) > 0): ?>
 <table border ="1" cellpadding="5" cellspacing="0" class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
     <thead>
         <tr>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Estoque</th>
        </tr>
     </thead>
     <tbody>
        <?php foreach ($produtos as $produto): ?>
        <tr>
            <td><?= htmlspecialchars($produto['nome_produtos']) ?></td>
            <td><?= htmlspecialchars($produto['descricao_produtos']) ?></td>
            <td><?= htmlspecialchars($produto['preco_produtos']) ?></td>
            <td><?= htmlspecialchars($produto['estoque_produtos']) ?></td>
            <td>
                <a class="w3-button w3-round w3-blue w3-hover-red w3-padding-large w3-margin-right"
                   href="/backend/produto/editar/<?= htmlspecialchars($produto['id_produto']) ?>">Editar</a>
            </td>
            <td>
                <a class="w3-button w3-round w3-red w3-hover-red w3-padding-large w3-margin-right"
                   href="/backend/produto/excluir/<?= htmlspecialchars($produto['id_produto']) ?>">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
     </tbody>
   </table>
   <div class="cao-controls" style="display:flex; justify-content:space-between; align-items:center; margin-top:20px;">
    <div class="page-selector" style="display:flex; align-items:center;">
        <div class="page-nav">
            <?php if ($cao['pagina_atual'] > 1): ?>
                <a href="/backend/produto/listar/<?= $paginacao['pagina_atual'] - 1 ?>">Anterior</a>
            <?php endif; ?>
            <span style="margin:0 10px;">Página <?= $paginacao['pagina_atual'] ?> de <?= $paginacao['ultima_pagina'] ?></span>
            <?php if ($paginacao['pagina_atual'] < $paginacao['ultima_pagina']): ?>
                <a href="/backend/produto/listar/<?= $paginacao['pagina_atual'] + 1 ?>">Próximo</a>
            <?php endif; ?>
        </div>
    </div>
</div>
  <?php else: ?>
      <div>Nenhum usuário encontrado.</div>
  <?php endif; ?>