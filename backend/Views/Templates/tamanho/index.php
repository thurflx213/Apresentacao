<div>Gerenciar tamanhos</div>
<a href="/backend/tamanho/criar" class="w3-button w3-yellow">Adicionar Tamanho</a>
<header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> Painel de tamanhos - Koketsu</b></h5>
  </header>
  <table id="tamanho" class="w3-table w3-striped w3-border w3-hoverable w3-black">
    <style>
  main {
    padding-bottom: 70px;
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
        <th>ID</th>
        <th>Produto</th>
        <th>Tamanho</th>
        <th>Quantidade</th>
          <th>Editar</th>
            <th>Excluir</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($tamanhos as $tamanho): ?>
        <tr style="background-color: <?= empty($tamanho['excluido_em']) ? '#000' : '#331111' ?>;">
          <td><?= htmlspecialchars($tamanho['id_tamanhos']) ?></td>
          <td><?= htmlspecialchars($tamanho['id_produto']) ?></td>
          <td><?= htmlspecialchars($tamanho['tamanho_tamanhos']) ?></td>
          <td><?= htmlspecialchars($tamanho['quantidade_tamanhos']) ?></td>
          <td><?php if(!empty($tamanho['excluido_em'])) {
                $label = "Ativar";
                $stilo = 'yellow';
                echo " <b style= 'background-color: red;'>Inativo</b>";
            }else{
                $label = "Desativar"; 
                $stilo = 'red';
                echo "Ativo";
            }
            ?></td>
            <td>
                <a class="w3-button w3-round w3-blue w3-hover-red w3-padding-large w3-margin-right"
                   href="/backend/tamanho/editar/<?= htmlspecialchars($tamanho['id_tamanhos']) ?>">Editar</a>
            </td>
            <td>
                <a class="w3-<?php echo $stilo; ?> w3-round  w3-padding-large w3-margin-right"
                   href="/backend/tamanho/excluir/<?= htmlspecialchars($tamanho['id_tamanhos']) ?>"  ><?php echo $label; ?></a>
            </td>
        </tr>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</main>
