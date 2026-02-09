<?php
$configFile = __DIR__ . "/backend/Config/settings.json";
if (file_exists($configFile)) {
    $config = json_decode(file_get_contents($configFile), true);
    if (!empty($config["manutencao"])) {
        if (!isset($_SESSION)) session_start();
        if (($_SESSION["usuario_tipo"] ?? "") !== "admin") {
            include __DIR__ . "/backend/Views/Templates/manutencao.php";
            exit;
        }
    }
}
?><!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dúvidas-Frequentes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="footer.css">
  <link rel="stylesheet" href="Trocas.css">
  <link rel="stylesheet" href="conteudo-do-trocas.css">
</head>
<body>
    <header>
        <!-- Navbar personalizada -->
        <nav id="navbar" class="navbar d-flex align-items-center px-4 sticky-top">
          <!-- Esquerda: Menu e Pesquisa -->
          <div class="navbar-section d-flex align-items-center">
            <button class="btn btn-link text-white d-flex align-items-center p-0 me-3" data-bs-toggle="offcanvas" data-bs-target="#menuOffcanvas">
              <i class="bi bi-list fs-5"></i> <span class="ms-1">Menu</span>
            </button>
      
          </div>
      
          <!-- Centro: Logo -->
          <div class="navbar-center">
            <a href="index.php">
            <img src="img/icons/logo.png" alt="Logo COMP" class="logo" />
            </a>
          </div>
      
          <!-- Direita: Login e Carrinho -->
          <div class="navbar-end d-flex justify-content-end align-items-center">
            <a href="login.php" class="icon-link"><i class="bi bi-person"></i> Login</a>
            <a href="https://instagram.com" class="icon-button"><i class="bi bi-bag"></i> Carrinho</a>
          </div>
        </nav>

         <!-- Menu lateral interativo -->
  <div class="offcanvas offcanvas-start" tabindex="-1" id="menuOffcanvas">
    <div class="offcanvas-header justify-content-end">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Fechar"></button>
    </div>
    <div class="offcanvas-body">
      <ul class="list-unstyled">
        <li><a class="text-white text-decoration-none d-block py-2" href="index.php">Início</a></li>
        <li><a class="text-white text-decoration-none d-block py-2" href="produto.php">Produtos</a></li>
        <li><a class="text-white text-decoration-none d-block py-2" href="sobre.php">Sobre</a></li>
        <li><a class="text-white text-decoration-none d-block py-2" href="#">Contato</a></li>
      </ul>
    </div>
        </header>
        <div class="sidebar">
            <ul>
              <li><a href="index.php">Início</a></li>
              <li><a href="sobre.php">Sobre a Koketsu</a></li>
              <li><a href="duvidas.php">Dúvidas Frequentes</a></li>
              <li><a href="Trocas.php">Trocas e Devoluções</a></li>
              <li><a href="politica.php">Política de Privacidade</a></li>
              <li><a href="frete.php">Frete e Entrega</a></li>
              <li><a href="#">Minha Conta</a></li>
              <li><a href="login.php">Carrinho</a></li>
              <li><a href="fidelidade.php">Programa de Fidelidade</a></li>
            </ul>
          </div>
          
          <main class="conteudo-principal container">
    <div class="card-conteudo">
      <h1><i class="bi bi-arrow-repeat text-warning"></i> Política de Trocas e Devoluções</h1>
      <p>Se os produtos da Koketsu não estiverem de acordo com o solicitado, você terá até <strong>7 dias corridos</strong> a partir do recebimento para solicitar a devolução da compra.</p>

      <h2><i class="bi bi-exclamation-circle"></i> Produto com defeito</h2>
      <p>Se o seu produto for entregue com <strong>defeito de fábrica</strong>, entre em contato conosco via WhatsApp e solicite a troca ou devolução.</p>
      <ul>
        <li>Desgaste por uso ou lavagem;</li>
        <li>Indicações de uso do produto;</li>
        <li>Dano acidental ou provocado;</li>
        <li>Lavagem inadequada do produto.</li>
      </ul>

      <h2><i class="bi bi-box-seam"></i> Arrependimento ou desistência</h2>
      <p>Caso receba o produto e opte pela desistência, poderá solicitar a devolução no prazo de <strong>7 dias corridos</strong>, conforme o Código de Defesa do Consumidor. O produto deve estar intacto, na embalagem original e com todos os itens inclusos.</p>

      <h2><i class="bi bi-truck"></i> Como devolver?</h2>
      <p>Você poderá devolver o produto pelos Correios ou transportadora. Após o envio, nossa equipe fará a análise e notificará você sobre o andamento da troca ou estorno.</p>

      <h2><i class="bi bi-cash-coin"></i> Reembolso</h2>
      <p>Após a análise e confirmação da devolução, o valor será restituído pelo mesmo método de pagamento utilizado.</p>
    </div>
  </main>

          
          

  <footer>
    <div class="container">
        <div class="coluna-footer">
            <h3 class="titulo">FAÇA PARTE DA NOSSA FAMILIA</h3>
            <p>Inscreva-se para ter acesso a exclusivo á venda antecipada, novidades e promoções.</p>
            <form action="mailto:seuemail@exemplo.com" method="POST" enctype="text/plain" class="form-email">
              <label for="email">Digite seu e-mail:</label>
              <input type="email" id="email" name="email" placeholder="E-mail" required>
              <button type="submit">Confirmar</button>
            </form>

        </div>
        <div class="coluna-footer">
            <h3 class="titulo">INSTITUCIONAL</h3>
            <p><a href="sobre.php" class="hover-destaque">Sobre a Koketsu</a></p>
        </div>

        <div class="coluna-footer">
            <h3 class="titulo">ATENDIMENTO AO CLIENTE</h3>
            <a href="duvidas.php"><p>Dúvidas Frequentes</p></a>
            <a href="Trocas.php"><P>Trocas e Devoluções</P></a>
            <a href="politica.php"><P>Politica de Privacidade</P></a>
            <a href="frete.php"><P>Frete e Entrega</P></a>
        </div>

        <div class="coluna-footer">
          <h3 class="titulo">MINHA CONTA</h3>
          <a href="#"><p>Minha Conta</p></a>
          <a href="#"><p>Carrinho</p></a>
          <a href="fidelidade.php"><p>Programa de Fidelidade</p></a>
          

        <h3 class="titulo fale-conosco">FALE CONOSCO</h3>
        <p>Atendimento:</p>
        <p>Segunda a Sabado (exceto feriados) das 09h ás 19h</p>
        <p>E-mail: sac@Koketsu.com.br</p>
        <A  href="https://WhatsApp.com" target="_blank"><button type="button" class="btn3">WhatsApp  <img src="img/icons/whatsapp.svg" alt=""></button></A>
       </div>
       <div class="copyright">
        <p>© 2025 Koketsu Grife. Todos os direitos reservados. Koketsu comércio de roupas. calçados e acessorios ltda.</p>
        <p></p>
      </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script.js"></script>
</body>
</html>