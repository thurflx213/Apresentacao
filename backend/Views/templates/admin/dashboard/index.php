<!-- <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
      <div class="w3-container w3-orange w3-padding-16">
        <div class="w3-left"><i class="fa fa-tags w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>120</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Produtos</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-yellow w3-padding-16">
        <div class="w3-left"><i class="fa fa-shopping-cart w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>87</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Pedidos</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-black  w3-padding-16">
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
  </div> -->
<main>
<div class="w3-container w3-padding-30">
    <h3><i class="fa fa-dashboard"></i> Meu Painel</h3>
    <h2>Bem-vindo de volta, <?= htmlspecialchars($nomeUsuario); ?>!</h2>
    <h2>Seu usuario, <?= htmlspecialchars($Tipo); ?>!</h2>
    <p>Esta é a sua área segura.</p>
    <a href="/backend/logout" class="logout-btn">Sair do Sistema</a>

</div>
  <header class="w3-container" style="padding-top:15px">
    <h5><b><i class="fa fa-dashboard"></i> Painel de Controle - Koketsu</b></h5>
  </header>

<table id="usuarios" class="w3-table w3-striped w3-border w3-hoverable w3-black">

<style>
  main {
    padding-bottom: 10px;
  }
#usuarios tr:nth-child(even),
#usuarios tr:nth-child(odd) {
  background-color: #000 !important;
  color: #f5f5f5 !important;
}
#usuarios tr:hover {
  background-color: #222 !important;
}
</style>
   <main>
      <thead>
         <tr>
            <th>Id-Usuarios</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Senha</th>
            <th>Tipo</th>
            <th>Status</th>
        </tr>
     </thead>
     <tbody>
         <?php foreach ($usuarios as $usuario): ?>
        <tr style="background-color: <?= empty($usuario['excluido_em']) ? '#000' : '#331111' ?>;">
            <td><?= htmlspecialchars($usuario['id_usuarios']) ?></td>
            <td><?= htmlspecialchars($usuario['nome_usuarios']) ?></td>
            <td><?= htmlspecialchars($usuario['email_usuarios']) ?></td>
            <td><?= htmlspecialchars($usuario['senha_usuarios']) ?></td>
            <td><?= htmlspecialchars($usuario['nivel_acesso']) ?></td>
            <td><?php if(!empty($usuario['excluido_em'])) {
                $label = "Ativar";
                $stilo = 'yellow';
                echo " <b style= 'background-color: red;'>Inativo</b>";
            }else{
                $label = "Desativar"; 
                $stilo = 'red';
                echo "Ativo";
            }
            ?></td>
        </tr>
        <?php endforeach; ?>
     </tbody>
 </table>
 </main>
 <div class="paginacao-controls" style="display:flex; justify-content:space-between; align-items:center; margin-top:20px;">
    <div class="page-selector" style="display:flex; align-items:center;">
       <div class="page-nav">
    <?php if (!empty($paginacao) && $paginacao['pagina_atual'] > 1): ?>
        <a href="/backend/usuario/listar/<?= $paginacao['pagina_atual'] - 1 ?>">Anterior</a>
    <?php endif; ?>

    <span style="margin:0 10px;">
        Página <?= $paginacao['pagina_atual'] ?? 1 ?> de <?= $paginacao['ultima_pagina'] ?? 1 ?>
    </span>

    <?php if (!empty($paginacao) && $paginacao['pagina_atual'] < $paginacao['ultima_pagina']): ?>
        <a href="/backend/usuario/listar/<?= $paginacao['pagina_atual'] + 1 ?>">Próximo</a>
    <?php endif; ?>
</div>
    </div>
</div>
 