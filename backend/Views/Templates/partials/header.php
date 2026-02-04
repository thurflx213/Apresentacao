<?php
use App\Koketsu\Core\Flash;
use App\Koketsu\Core\Session;

// Função auxiliar para determinar a classe ativa do menu
function isActive($link_uri, $current_uri) {
    // Remove parâmetros GET para comparação limpa
    $clean_link = strtok($link_uri, '?');
    $clean_current = strtok($current_uri, '?');

    // Verifica se o link_uri é igual ao current_uri
    return ($clean_link == $clean_current) ? 'active-link' : '';
}

// Tenta obter a URI atual. O valor de $_SERVER['REQUEST_URI'] pode precisar de ajustes dependendo do seu ambiente.
$current_uri = $_SERVER['REQUEST_URI'] ?? '/backend/admin/dashboard'; 
?>

<!DOCTYPE html>
<html>
<head>
<title>Koketsu | Loja de Roupas</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>

/* ======= RESET GERAL ======= */
html, body {
  height: 100%;
  margin: 0;
  padding: 0;
  background-color: #111111 !important; /* Fundo principal mais escuro */
  color: #f5f5f5 !important;
  font-family: "Segoe UI", sans-serif;
  display: flex;
  flex-direction: column;
}

/* ======= TOPO ======= */
.w3-top, .w3-bar.w3-top {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  background-color: #000000ff !important;
  color: #000 !important;
  z-index: 1000;
  height: 80px;
  line-height: 60px;
}

/* ====== MENU LATERAL ====== */
.w3-sidebar {
  /* Fundo mais claro para contraste */
  background-color: #1a1a1a !important; 
  color: #f5f5f5 !important;
  width: 260px !important;
  position: fixed !important;
  top: 0;
  left: 0;
  height: 100vh !important;
  overflow-y: auto;
  padding-top: 70px; /* Ajuste para melhor visual de perfil */
  border-right: 1px solid #282828;
}

.w3-sidebar a {
  display: flex;
  align-items: center;
  gap: 10px;
  color: #fff !important;
  background-color: transparent !important;
  padding: 12px 20px !important;
  font-size: 15px;
  font-weight: 500;
  border-radius: 8px;
  transition: all 0.25s ease-in-out;
  margin: 4px 12px;
}

/* Estilo do link ativo/selecionado */
.w3-sidebar a.active-link {
    background-color: #dfd155ff !important; /* Amarelo/dourado do tema */
    color: #000 !important;
    font-weight: 700;
    transform: translateX(0); 
    box-shadow: 0 0 8px #dfd155aa;
}

/* Hover nos links não ativos */
.w3-sidebar a:hover:not(.active-link) {
  background-color: #ffcc0044 !important; /* Cor mais sutil no hover */
  color: #fff !important;
  transform: translateX(4px);
  box-shadow: none;
}

/* Ícones do menu */
.w3-sidebar a i {
  font-size: 18px;
  width: 24px;
  text-align: center;
}

/* Ícones do perfil (mensagem, usuário, configurações) */
.w3-container .w3-margin-top a {
  display: inline-flex;
  justify-content: center;
  align-items: center;
  width: 40px;
  height: 40px;
  margin: 0 6px;
  background-color: #1a1a1a;
  border-radius: 50%;
  border: 1px solid #333;
  color: #ffcc00;
  transition: all 0.3s ease-in-out;
}

.w3-container .w3-margin-top a:hover {
  background-color: #ffcc00;
  color: #000;
  box-shadow: 0 0 10px #ffcc00aa;
  transform: translateY(-3px);
}

.w3-container .w3-margin-top i {
  font-size: 18px;
}


/* ====== BOTÃO SAIR ====== */
.logout-btn {
  display: inline-block;
  background-color: #e74c3c !important;
  color: #fff !important;
  padding: 10px 16px;
  border-radius: 6px;
  font-weight: 600;
  text-decoration: none;
  transition: background-color 0.2s ease;
}

.logout-btn:hover {
  background-color: #ff6b5a !important;
  color: #fff !important;
  text-decoration: none;
  box-shadow: 0 0 10px #ff6b5a66;
}

/* ====== CONTEÚDO ====== */

.w3-main {
  flex: 1; 
  margin-left: 260px !important;
  margin-top: 85px !important; 
  padding: 50px !important;
  background-color: #111 !important;
  color: #f5f5f5 !important;
  transition: all 0.3s ease-in-out;
}

/* ======= SEPARADOR DE PERFIL ======= */
hr {
    border-color: #333 !important;
}


/* ======= BOTÕES/TABELAS (Estilos de tema escuro) ======= */
.w3-table tr:nth-child(even) {
    background-color: #1a1a1a !important;
}
.w3-tag {
    padding: 4px 8px;
    font-size: 12px;
    font-weight: bold;
}
.w3-table .w3-button {
    font-size: 11px;
    padding: 8px 12px; 
    margin: 2px;
    text-transform: uppercase;
}
.w3-table {
    color: #f1f1f1;
}
.w3-table thead tr {
    background-color: #333 !important;
    color: white;
}
.w3-card, .w3-white, .w3-light-grey {
    background-color: #000000ff !important;
    color: #ffffffff !important;
    border: 1px solid #222 !important;
}

/* ======= INPUTS ======= */
input, select, textarea {
  background-color: #222 !important;
  color: #fff !important;
  border: 1px solid #555 !important;
  border-radius: 4px;
  padding: 8px;
}

/* ======= SCROLLBAR (opcional) ======= */
::-webkit-scrollbar {
  width: 8px;
}
::-webkit-scrollbar-thumb {
  background-color: #333;
  border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
  background-color: #555;
}

</style>
</head>
<body class="">

  <?php
    $session = new Session();
    if($session->has('usuario_id')):
     
  ?>

<div class="w3-bar w3-top w3-theme w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-black" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <div class="w3-bar" style="background-color:#000; height:80px; display:flex; align-items:center; justify-content:center;">
    <a href="../../index.html">
  <img src="/img/logo.png" alt="Koketsu Logo" height="80px" >
  </a>
  </div>
</div>

<nav class="w3-sidebar w3-collapse w3-animate-left" style="z-index:3;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-container w3-center w3-padding">
  <div class="w3-container w3-center w3-padding">
    <?php
    // Verifica se a foto existe na sessão, senão usa a padrão
    $foto_raw = $_SESSION['foto_usuarios'] ?? null;
    if ($foto_raw && !filter_var($foto_raw, FILTER_VALIDATE_URL)) {
        // Se não é uma URL, constrói o caminho completo
        $foto_exibir = '/backend/upload/' . $foto_raw;
    } else {
        $foto_exibir = $foto_raw ?? '/img/logoperf.jpg';
    }
    ?>
    
    <img src="<?php echo htmlspecialchars($foto_exibir); ?>" 
         class="w3-circle" 
         style="width:70px; height:70px; object-fit: cover; border:2px solid #ffcc00;"
         alt="Foto de perfil"
         onerror="this.src='/img/logoperf.jpg';">
</div>
  <h5 class="w3-margin-top">Bem-vindo, <strong><?= htmlspecialchars($session->get('usuario_nome')); ?></strong></h5>
  <div class="w3-margin-top">
    <a href="#" title="Mensagens"><i class="fa fa-envelope w3-hover-text-yellow"></i></a>
    <a href="#" title="Perfil" style="margin: 0 10px;"><i class="fa fa-user w3-hover-text-yellow"></i></a>
    <a href="#" title="Configurações"><i class="fa fa-cog w3-hover-text-yellow"></i></a>
  </div>
</div>
<hr style="border-color:#333;"> 
  <div class="w3-container">
    <h5>Painel Koketsu</h5>
  </div>
  <div class="w3-bar-block">
    <?php
      if ($session->get('usuario_tipo') == 'admin'){
    ?>
    <a href="/backend/admin/dashboard" class="w3-bar-item w3-button w3-padding <?php echo isActive('/backend/admin/dashboard', $current_uri); ?>">
        <i class="fa fa-home fa-fw"></i> Início
    </a>
    
    <a href="/backend/usuario/listar" class="w3-bar-item w3-button w3-padding <?php echo isActive('/backend/usuario/listar', $current_uri); ?>">
        <i class="fa fa-users fa-fw"></i> Listar
    </a>
    <a href="/backend/produtos/listar" class="w3-bar-item w3-button w3-padding <?php echo isActive('/backend/produtos/listar', $current_uri); ?>">
        <i class="fa fa-tags fa-fw"></i> Produtos
    </a>
    <a href="/backend/pedido/listar" class="w3-bar-item w3-button w3-padding <?php echo isActive('/backend/pedido/listar', $current_uri); ?>">
        <i class="fa fa-shopping-cart fa-fw"></i> Pedidos
    </a>
    <a href="/backend/itenspedidos/listar" class="w3-bar-item w3-button w3-padding <?php echo isActive('/backend/itenspedidos/listar', $current_uri); ?>">
        <i class="fa fa-dropbox fa-fw"></i> ItensPedidos
    </a>
    <a href="/backend/usuario/listar" class="w3-bar-item w3-button w3-padding <?php echo isActive('/backend/perfil/listar', $current_uri); ?>">
        <i class="fa fa-users fa-fw"></i> Clientes
    </a>
    <?php
      }
    ?>
    <a href="/backend/cliente/pedidos" class="w3-bar-item w3-button w3-padding <?php echo isActive('/backend/cliente/pedidos', $current_uri); ?>">
        <i class="fa fa-user-circle fa-fw"></i> Perfil
    </a>
    <?php if ($session->get('usuario_tipo') == 'admin'){ ?>
    <a href="/backend/avaliacao/listar" class="w3-bar-item w3-button w3-padding <?php echo isActive('/backend/avaliacao', $current_uri); ?>">
        <i class="fa fa-star fa-fw"></i> Avaliações
    </a>
    <a href="/backend/relatorios" class="w3-bar-item w3-button w3-padding <?php echo isActive('/backend/relatorios', $current_uri); ?>">
        <i class="fa fa-bar-chart fa-fw"></i> Relatórios
    </a>
    <a href="/backend/configuracoes" class="w3-bar-item w3-button w3-padding <?php echo isActive('/backend/configuracoes', $current_uri); ?>">
        <i class="fa fa-cog fa-fw"></i> Configurações
    </a><br><br>
      <?php } ?>
  </div>
</nav>

<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<div class="w3-main" style="margin-left:260px;margin-top:80px;">
    
    <?php
    endif;
$mensagem = Flash::get();
if(isset($mensagem)){
foreach($mensagem as $key => $value){
    if($key == "type"){
        $tipo = $value == "success" ? "alert-success" : "alert-danger";
    echo "<div class='alert $tipo' role='alert'>";
    }else{
        echo $value;
        echo "</div>";
    }
}
}
?>

<script> 
    // Funções para abrir/fechar o menu lateral em telas pequenas
    function w3_open() {
        const mySidebar = document.getElementById('mySidebar');
        const myOverlay = document.getElementById('myOverlay');
        if (mySidebar.style.display === 'block') {
            w3_close();
        } else {
            mySidebar.style.display = 'block';
            myOverlay.style.display = 'block';
        }
    }

    function w3_close() {
        const mySidebar = document.getElementById('mySidebar');
        const myOverlay = document.getElementById('myOverlay');
        mySidebar.style.display = 'none';
        myOverlay.style.display = 'none';
    }

    // Script para desaparecer as mensagens de alerta/flash
    setTimeout(() => { 
        const alert = document.querySelector('.alert'); 
        if(alert){ 
            alert.style.opacity = '0'; 
            alert.style.transform = 'translateY(-20px)'; 
            setTimeout(() => alert.remove(), 400); 
        } 
    }, 3000); 
</script>
</body>
</html>