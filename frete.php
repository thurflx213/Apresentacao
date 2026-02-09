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
  <title>Frete-e-Entrega</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="footer.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="duvidas.css">
  <link rel="stylesheet" href="frete.css">
</head>
<body>
    <div class="page-content">
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
          <main class="conteudo">
        <h1>📦 Frete e Entrega</h1>

        <section>
            <h2>1. Prazos de Entrega</h2>
            <p>O prazo de entrega pode variar de acordo com a região, forma de envio e disponibilidade dos Correios ou transportadoras parceiras. O prazo estimado será informado no momento da compra.</p>
        </section>

        <section>
            <h2>2. Formas de Envio</h2>
            <p>Oferecemos diferentes opções de frete, que podem incluir:</p>
            <ul>
                <li>Correios (PAC ou Sedex);</li>
                <li>Transportadora parceira;</li>
                <li>Retirada em loja (quando disponível).</li>
            </ul>
        </section>

        <section>
            <h2>3. Acompanhamento do Pedido</h2>
            <p>Após a confirmação do pagamento, você receberá um código de rastreamento por e-mail para acompanhar a entrega.</p>
        </section>

        <section>
            <h2>4. Regras Importantes</h2>
            <ul>
                <li>Os prazos de entrega começam a contar a partir da confirmação do pagamento.</li>
                <li>É responsabilidade do cliente fornecer o endereço correto e completo.</li>
                <li>Em caso de ausência, a transportadora poderá realizar novas tentativas de entrega.</li>
            </ul>
        </section>

        <section>
            <h2>5. Dúvidas</h2>
            <p>Se tiver qualquer dúvida sobre o frete ou entrega, entre em contato pelo nosso <a href="contato.php">atendimento</a>.</p>
        </section>
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