<?php
// Carrega produtos do banco de dados
require_once __DIR__ . '/vendor/autoload.php';

use App\Koketsu\Database\Database;
use App\Koketsu\Models\Produtos;

$db = Database::getInstance();
$produtosModel = new Produtos($db);
$produtos = $produtosModel->buscarProdutosAtivos(); // Busca todos os produtos ativos
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nossos Produtos - Koketsu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="footer.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Oswald:wght@500;700&display=swap" rel="stylesheet">

    <style>
        /* =================================================================== */
        /* 1. Reset Básico e Variáveis CSS (Custom Properties) */
        /* =================================================================== */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            /* Cores */
            --cor-primaria: #FFEA00; /* Amarelo Elétrico/Neon */
            --cor-secundaria: #FFC400; /* Amarelo Dourado para Hover */
            --cor-fundo-pagina: #121212;
            --cor-fundo-card: #1E1E1E;
            --cor-texto-claro: #F0F0F0;
            --cor-texto-escuro: #121212;
            --cor-borda-sutil: #333;

            --navbar-height: 80px;

            /* Espaçamentos e Tipografia */
            --espacamento-pequeno: 8px;
            --espacamento-medio: 12px;
            --espacamento-grande: 20px;
            --radius-borda: 8px;
            --font-padrao: 'Montserrat', sans-serif;
            --font-titulo: 'Oswald', sans-serif; 
        }

        body {
            font-family: var(--font-padrao);
            background-color: var(--cor-fundo-pagina);
            padding: 0; 
            color: var(--cor-texto-claro);
        }
       
        main {
    padding-top: var(--navbar-height); /* Empurra o conteúdo principal para baixo */
}
        
        .container {
            max-width: 1200px; 
            margin: 0 auto; 
            padding: 0 15px;
        }
        
        /* Navbar para consistência visual */
        #navbar {
            background-color: #000; /* Fundo preto para destaque */
            border-bottom: 1px solid var(--cor-borda-sutil);
            z-index: 100; /* Garante que a navbar fique acima de todos os outros elementos */
            width: 100%;
        }

        .icon-link, .icon-button {
            color: var(--cor-texto-claro) !important;
            text-decoration: none;
            margin-left: var(--espacamento-grande);
            transition: color 0.2s;
        }
        .icon-link:hover, .icon-button:hover {
            color: var(--cor-primaria) !important;
        }

        /* =================================================================== */
        /* TÍTULO CENTRALIZADO (H2: Nossos Produtos) */
        /* =================================================================== */
        .produtos h2 { 
            text-align: center;
            font-family: var(--font-titulo);
            color: var(--cor-primaria);
            font-size: 2.5em;
            margin-bottom: var(--espacamento-grande) * 1.5; 
            margin-top: var(--espacamento-grande) * 2; 
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 0 0 10px rgba(255, 234, 0, 0.3);
        }
        
        /* =================================================================== */
        /* BARRA DE FILTROS (NOVO) */
        /* =================================================================== */
        .filter-btn {
            border: 1px solid var(--cor-borda-sutil);
            color: var(--cor-texto-claro) !important;
            background-color: var(--cor-fundo-card) !important;
            transition: background-color 0.3s;
        }
        .filter-btn:hover {
            background-color: #333 !important;
        }
        .dropdown-menu-dark {
            background-color: var(--cor-fundo-card);
            border-color: var(--cor-borda-sutil);
        }
        .dropdown-menu-dark .dropdown-item {
            color: var(--cor-texto-claro);
        }
        .dropdown-menu-dark .dropdown-item:hover {
            background-color: var(--cor-borda-sutil);
            color: var(--cor-primaria);
        }

        /* =================================================================== */
        /* 2. Grid de Produtos */
        /* =================================================================== */
        .produtos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); 
            gap: var(--espacamento-medio); 
            margin-bottom: 60px;
        }

        /* =================================================================== */
        /* 3. Card do Produto (Otimizado) */
        /* =================================================================== */
        .produto-card {
            border: 1px solid var(--cor-borda-sutil);
            border-radius: var(--radius-borda);
            overflow: hidden;
            background-color: var(--cor-fundo-card);
            box-shadow: 0 4px 10px rgba(0,0,0,0.5); 
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative; /* Para a tag */
        }

        .produto-card:hover {
            transform: translateY(-5px); /* Mais destaque */
            box-shadow: 0 10px 25px rgba(255, 234, 0, 0.2); /* Sombra amarela sutil */
            border-color: var(--cor-secundaria);
        }

        .produto-card__image-container {
            position: relative;
            overflow: hidden;
            height: 250px;
        }
        
        .produto-card__img {
            width: 100%;
            height: 100%;
            object-fit: cover; 
            display: block;
            opacity: 0.9;
            transition: transform 0.4s ease, opacity 0.4s ease; /* Adicionar transição de transform */
        }
        
        .produto-card:hover .produto-card__img {
            transform: scale(1.08); /* Efeito zoom no hover */
            opacity: 1;
        }

        .produto-card__tag {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: var(--cor-primaria);
            color: var(--cor-texto-escuro);
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.7em;
            font-weight: 700;
            text-transform: uppercase;
            z-index: 10;
        }
        
        .produto-card__content {
            padding: var(--espacamento-medio); 
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            text-align: center;
        }
        
        .produto-card__titulo {
            font-size: 1.1em;
            color: var(--cor-texto-claro);
            margin-bottom: 2px;
            font-weight: 700; 
            line-height: 1.2;
            text-transform: uppercase;
        }
        
        .produto-card__categoria {
            font-size: 0.8em;
            color: #AAAAAA;
            margin-bottom: 5px;
        }

        .produto-card__preco {
            font-weight: 800;
            color: var(--cor-primaria);
            font-size: 1.3em;
            margin: 8px 0 var(--espacamento-pequeno) 0;
            letter-spacing: 0.5px;
        }

        .produto-card__button {
            background: var(--cor-primaria);
            color: var(--cor-texto-escuro);
            border: none;
            padding: var(--espacamento-pequeno) var(--espacamento-medio); 
            cursor: pointer;
            width: 100%;
            font-size: 1em;
            text-transform: uppercase;
            font-weight: 700;
            transition: background-color 0.3s ease, transform 0.1s ease;
            margin-top: auto;
            border-radius: 0 0 var(--radius-borda) var(--radius-borda); /* Botão vai para a base do card */
            letter-spacing: 1px;
        }
        
        .produto-card__button:hover {
            background-color: var(--cor-secundaria);
        }
        
        /* =================================================================== */
        /* 4. Resumo do Carrinho (Otimizado) */
        /* =================================================================== */
        .carrinho-resumo {
            max-width: 650px;
            width: 90%; 
            margin: 0 auto;
            left: 50%; 
            transform: translateX(-50%);
            padding: var(--espacamento-grande);
            border: 2px solid var(--cor-primaria);
            border-radius: var(--radius-borda) var(--radius-borda) 0 0; /* Arredondamento apenas no topo */
            background-color: var(--cor-fundo-card);
            box-shadow: 0 -4px 15px rgba(255, 234, 0, 0.3); /* Sombra para destacar */
            text-align: left;
            position: fixed;
            bottom: 0;
            z-index: 1000;
            
            max-height: 70px; /* Altura fechada */
            transition: max-height 0.5s ease-in-out, padding 0.5s ease-in-out; 
            overflow: hidden; 
        }

        .carrinho-resumo.expandido {
            max-height: 450px; /* Altura expandida */
            padding-bottom: var(--espacamento-grande);
        }
        
        .carrinho-resumo h2 {
            font-family: var(--font-titulo);
            color: var(--cor-primaria);
            font-size: 1.5em;
            text-transform: uppercase;
            text-align: center; 
            cursor: pointer; 
            margin-bottom: 0;
            padding: 0;
        }

        .carrinho-resumo:not(.expandido) #cart-items,
        .carrinho-resumo:not(.expandido) .cart-total-line,
        .carrinho-resumo:not(.expandido) #btn-finalizar {
            display: none;
        }
        
        .cart-total-line {
            font-size: 1.2em;
            font-weight: 700;
            color: var(--cor-texto-claro);
            margin: var(--espacamento-medio) 0;
            border-top: 1px solid var(--cor-borda-sutil);
            padding-top: var(--espacamento-pequeno);
        }

        #btn-finalizar {
            background: #28a745 !important; 
            color: white !important;
            border-radius: var(--radius-borda);
        }
        #btn-finalizar:hover {
            background: #1e7e34 !important;
        }

        /* =================================================================== */
        /* 5. FOOTER (Ajustes de consistência) */
        /* =================================================================== */
        /* Adicione o CSS do seu footer.css aqui se for necessário */
        footer {
            background-color: #000;
            border-top: 2px solid var(--cor-borda-sutil);
            padding: 40px 0;
            color: #999;
        }
        footer h3.titulo {
            color: var(--cor-primaria);
            font-family: var(--font-titulo);
            font-size: 1.2em;
            margin-bottom: var(--espacamento-medio);
            text-transform: uppercase;
        }
        footer p, footer a {
            color: #AAA;
            text-decoration: none;
            line-height: 1.8;
            transition: color 0.2s;
        }
        footer a:hover {
            color: var(--cor-primaria);
        }
        .form-email input[type="email"] {
            background-color: var(--cor-fundo-card);
            border: 1px solid var(--cor-borda-sutil);
            color: var(--cor-texto-claro);
            padding: 8px;
            width: 70%;
        }
        .form-email button {
            background-color: var(--cor-primaria);
            color: var(--cor-texto-escuro);
            border: none;
            padding: 8px 15px;
            font-weight: 700;
        }
    </style>
</head>
<header>
    <nav id="navbar" class="navbar d-flex align-items-center px-4 sticky-top">
        <div class="navbar-section d-flex align-items-center">
            <button class="btn btn-link text-white d-flex align-items-center p-0 me-3" data-bs-toggle="offcanvas" data-bs-target="#menuOffcanvas">
                <i class="bi bi-list fs-5"></i> <span class="ms-1">Menu</span>
            </button>
        </div>
        <a href="index.html">
            <img src="img/icons/logo.png" alt="Logo COMP" class="logo" />
        </a>
        <div class="navbar-end d-flex justify-content-end align-items-center">
            <a href="login.html" class="icon-link"><i class="bi bi-person"></i> Login</a>
            <a href="" class="icon-button"><i class="bi bi-bag"></i> Carrinho</a>
        </div>
    </nav>

    <div class="offcanvas offcanvas-start botao-fechar" tabindex="-1" id="menuOffcanvas">
        <div class="offcanvas-header justify-content-end">
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Fechar"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="list-unstyled">
                <li><a class="text-white text-decoration-none d-block py-2" href="index.html">Início</a></li>
                <li><a class="text-white text-decoration-none d-block py-2" href="produto.html">Produtos</a></li>
                <li><a class="text-white text-decoration-none d-block py-2" href="sobre.html">Sobre</a></li>
                <li><a class="text-white text-decoration-none d-block py-2" href="#">Contato</a></li>
            </ul>
        </div>
    </div>
</header>
<body>
    <main>
        <section class="produtos" style="padding: 40px 0;">
            <div class="container">
                <h2>Nossos Produtos</h2>
                
                <div class="filter-bar d-flex justify-content-between align-items-center mb-4">
                    <div class="dropdown">
                        <button class="btn btn-dark dropdown-toggle filter-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Categorias
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="#" data-filter="all">Todas</a></li>
                            <li><a class="dropdown-item" href="#" data-filter="Camisetas">Camisetas</a></li>
                            <li><a class="dropdown-item" href="#" data-filter="Calças">Calças</a></li>
                            <li><a class="dropdown-item" href="#" data-filter="Acessórios">Acessórios</a></li>
                        </ul>
                    </div>

                    <div class="dropdown">
                        <button class="btn btn-dark dropdown-toggle filter-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Ordenar por: Mais Recente
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="#">Mais Recente</a></li>
                            <li><a class="dropdown-item" href="#">Menor Preço</a></li>
                            <li><a class="dropdown-item" href="#">Maior Preço</a></li>
                        </ul>
                    </div>
                </div>
                <div id="produtos-lista" class="produtos-grid">
                    <?php
                    if (isset($produtos) && is_array($produtos)):
                        foreach ($produtos as $produto): 
                            // Simulação de campos que você precisa ter no seu array $produtos
                            $id = htmlspecialchars($produto['id_produto'] ?? '0');
                            $nome = htmlspecialchars($produto['nome_produtos'] ?? 'Nome Indisponível');
                            $preco = htmlspecialchars($produto['preco_produtos'] ?? '0.00');
                            $imagem = htmlspecialchars($produto['imagem_produtos'] ?? 'default.jpg');
                            $categoria = htmlspecialchars($produto['id_categoria'] ?? 'Sem Categoria');
                    ?>
                    <div class="produto-card" data-category="<?= $categoria ?>">
                        <div class="produto-card__image-container">
                            <?php if ($produto['is_novo'] ?? false): ?>
                                <span class="produto-card__tag">Novo</span>
                            <?php endif; ?>
                            <img src="/backend/upload/<?= $imagem; ?>" alt="<?= $nome; ?>" class="produto-card__img" onerror="this.src='/img/placeholder.jpg'">
                        </div>
                        <div class="produto-card__content">
                            <div>
                                <h3 class="produto-card__titulo"><?= $nome; ?></h3>
                                <p class="produto-card__categoria"><?= $categoria; ?></p>
                            </div>
                            <p class="produto-card__preco">R$ <?= number_format($preco, 2, ',', '.'); ?></p>
                            <button class="produto-card__button add-to-cart" data-id="<?= $id; ?>">Adicionar ao Carrinho</button>
                        </div>
                    </div>
                    <?php 
                        endforeach; 
                    else:
                    ?>
                    <p class="w3-center w3-col m12" style="color: #F0F0F0; grid-column: 1 / -1;">Nenhum produto encontrado.</p>
                    <?php endif; ?>
                    </div>
                </div>
        </section>

        <section class="carrinho">
            <div class="container">
                <div id="carrinho-resumo" class="carrinho-resumo"> 
                    <h2>Seu Carrinho (<span id="cart-count">0</span> itens)</h2>
                    <ul id="cart-items">
                        </ul>
                    <p class="cart-total-line">Total: R$ <span id="cart-total">0.00</span></p>
                    <button id="btn-finalizar" class="produto-card__button">Finalizar Pedido</button>
                    <div id="pedido-status" style="margin-top: 15px;"></div>
                </div>
            </div>
        </section>
    </main>

   <div class="top-bar">
    <div class="info-box">
      <i class="bi bi-clock"></i>
      <div>
        <h4>ATENDIMENTO</h4>
        <p>SEG A SEX DAS 08H-11:30 E DAS 13H-17:30H</p>
      </div>
    </div>
  
    <div class="info-box">
      <i class="bi bi-box-seam"></i>
      <div>
        <h4>TROCAS E DEVOLUÇÕES</h4>
        <p>ATÉ 7 DIAS PARA TROCAS OU DEVOLUÇÕES</p>
      </div>
    </div>
  
    <div class="info-box">
      <i class="bi bi-truck"></i>
      <div>
        <h4>FRETE</h4>
        <p>GRÁTIS PARA COMPRAS ACIMA DE R$349<br>PARA TODO O BRASIL</p>
      </div>
    </div>
  
    <div class="info-box">
      <i class="bi bi-credit-card"></i>
      <div>
        <h4>PARCELAMENTO</h4>
        <p>EM ATÉ 6X SEM JUROS NO CARTÃO</p>
      </div>
    </div>
  </div>
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
            <p><a href="sobre.html" class="hover-destaque">Sobre a Koketsu</a></p>
        </div>

        <div class="coluna-footer">
            <h3 class="titulo">ATENDIMENTO AO CLIENTE</h3>
            <a href="duvidas.html"><p>Dúvidas Frequentes</p></a>
            <a href="Trocas.html"><P>Trocas e Devoluções</P></a>
            <a href="politica.html"><P>Politica de Privacidade</P></a>
            <a href="frete.html"><P>Frete e Entrega</P></a>
        </div>

        <div class="coluna-footer">
          <h3 class="titulo">MINHA CONTA</h3>
          <a href="#"><p>Minha Conta</p></a>
          <a href="carrinho.html"><p>Carrinho</p></a>
          <a href="fidelidade.html"><p>Programa de Fidelidade</p></a>
          

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
    <script src="js/carrinho.js" defer></script>
    <script src="js/pedidos.js" defer></script>
    <script src="js/produtos.js" defer></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const carrinho = document.getElementById('carrinho-resumo');
            
            // Alterna a classe 'expandido' no clique no container do carrinho
            carrinho.addEventListener('click', (e) => {
                // Evita que clicar em um botão interno feche o carrinho
                if (e.target.tagName !== 'BUTTON') { 
                    carrinho.classList.toggle('expandido');
                }
            });
            
            // Se o carrinho tiver itens (via JS externo), garantir que ele apareça minimizado
            // (Isto seria tratado no js/carrinho.js)
        });
    </script>
</body>
</html>