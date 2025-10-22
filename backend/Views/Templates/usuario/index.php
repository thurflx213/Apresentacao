<h3>gerenciar usuarios</h3>
<a href="/backend/usuario/criar" class="w3-button w3-blue">Adicionar Novo Usuário</a>
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> Painel de Controle - Koketsu</b></h5>
  </header>

<table id="usuarios" class="w3-table w3-striped w3-border w3-hoverable w3-black">

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
            <th>Id-Usuarios</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Tipo</th>
            <th>Editar</th>
            <th>Excluir</th>
        </tr>
     </thead>
     <tbody>
         <?php foreach ($usuarios as $usuario): ?>
        <tr style="background-color: <?= empty($usuario['excluido_em']) ? '#000' : '#331111' ?>;">
            <td><?= htmlspecialchars($usuario['id_usuarios']) ?></td>
            <td><?= htmlspecialchars($usuario['nome_usuarios']) ?></td>
            <td><?= htmlspecialchars($usuario['email_usuarios']) ?></td>
            <td><?= htmlspecialchars($usuario['nivel_acesso']) ?></td>
            <td><?php if(!empty($usuario['excluido_em'])) {
                echo " <b style= 'background-color: red;'>Inativo</b>";
            }else{
                echo "Ativo";
            }
            ?></td>
            <td>
                <a class="w3-button w3-round w3-blue w3-hover-red w3-padding-large w3-margin-right"
                   href="/backend/usuario/editar/<?= htmlspecialchars($usuario['id_usuarios']) ?>">Editar</a>
            </td>
            <td>
                <a class="w3-button w3-round w3-red w3-hover-red w3-padding-large w3-margin-right"
                   href="/backend/usuario/excluir/<?= htmlspecialchars($usuario['id_usuarios']) ?>">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
     </tbody>
 </table>
 </main>
