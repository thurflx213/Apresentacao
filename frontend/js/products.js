/**
 * Gerenciador de Produtos e Vitrine
 * Responsável por renderizar e gerenciar a exibição de produtos
 */

const ProductManager = (() => {
  const API_ENDPOINT = '/api/vitrine.php';

  /**
   * Formata valor para moeda
   */
  const formatPrice = (value) => {
    return parseFloat(value).toFixed(2).replace('.', ',');
  };

  /**
   * Normaliza caminho de imagem para a nova estrutura
   */
  const normalizeImagePath = (path) => {
    if (!path) return path;
    if (path.startsWith('../') || path.startsWith('http://') || path.startsWith('https://')) {
      return path;
    }
    if (path.startsWith('img/')) {
      return `../${path}`;
    }
    return path;
  };

  /**
   * Gera caminho WebP alternativo
   */
  const getWebpPath = (path) => {
    if (!path) return path;
    return path.replace(/\.(jpg|jpeg|png)$/i, '.webp');
  };

  /**
   * Cria o HTML de um card de produto para homepage
   */
  const createProductCardHome = (product) => {
    const precoFormatado = formatPrice(product.preco);
    const imgSrc = normalizeImagePath(product.img);
    const imgWebp = getWebpPath(imgSrc);

    let badge = '';
    if (product.desconto) {
      badge = `<div class="product-badge">${product.desconto}</div>`;
    } else if (product.oferta) {
      badge = `<div class="product-badge">${product.oferta}</div>`;
    } else if (product.novo) {
      badge = `<div class="product-badge">NOVO</div>`;
    }

    return `
      <div class="product-card">
        <div class="product-image">
          ${badge}
          <button class="product-favorite" type="button">
            <i class="bi bi-heart"></i>
          </button>
          <picture>
            <source srcset="${imgWebp}" type="image/webp">
            <img 
              src="${imgSrc}" 
              alt="${product.nome}" 
              loading="lazy"
            >
          </picture>
        </div>
        <div class="product-info">
          <h3 class="product-name">${product.nome}</h3>
          <p class="product-price">R$ ${precoFormatado}</p>
          <button class="btn-buy" data-product-id="${product.id}">
            <i class="bi bi-cart"></i>
            COMPRAR
          </button>
        </div>
      </div>
    `;
  };

  /**
   * Cria um card de produto para outros layouts
   */
  const createProductCard = (product) => {
    const precoFormatado = formatPrice(product.preco);
    const parcelasFormatadas = formatPrice(
      product.parcelas || product.preco / 6
    );

    // Preço original (20% a mais para simular desconto)
    const precoOriginal = (product.preco * 1.2).toFixed(2);
    const precoOriginalFormatado = formatPrice(precoOriginal);

    let badges = '';
    if (product.desconto) {
      badges += `<span class="badge sale-badge">${product.desconto}</span>`;
    }
    if (product.oferta) {
      badges += `<span class="badge sale-badge-alt">${product.oferta}</span>`;
    }

    const imgSrc = normalizeImagePath(product.img);
    const imgWebp = getWebpPath(imgSrc);

    return `
      <div class="product-card">
        <a href="produto.html?id=${product.id}" class="card-link">
          <div class="card-img-container">
            ${badges ? `<div class="card-badges">${badges}</div>` : ''}
            <picture>
              <source srcset="${imgWebp}" type="image/webp">
              <img 
                src="${imgSrc}" 
                alt="${product.nome}" 
                class="card-main-img"
                loading="lazy"
              >
            </picture>
          </div>
          <div class="card-body">
            <h5 class="card-title">${product.nome}</h5>
            <div class="price-info">
              <p class="original-price">R$ ${precoOriginalFormatado}</p>
              <p class="main-price">R$ ${precoFormatado}</p>
              <p class="card-installments">ou <span class="installments-value">6x de R$ ${parcelasFormatadas}</span> sem juros</p>
            </div>
          </div>
        </a>
        <div class="card-actions">
          <button class="btn-quick-buy" data-product-id="${product.id}">
            Adicionar ao Carrinho
          </button>
        </div>
      </div>
    `;
  };


  /**
   * Cria uma seção de carrossel de produtos
   */
  const createCarouselSection = (category) => {
    const section = document.createElement('section');
    section.className = 'category-section py-5';

    const titleHtml = `
      <h2 class="h2-titulo">${category.categoria}</h2>
      <p class="category-tag">${category.tag}</p>
      <div id="carousel-${category.categoria.replace(/\s+/g, '-')}" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner"></div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-${category.categoria.replace(/\s+/g, '-')}" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel-${category.categoria.replace(/\s+/g, '-')}" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Próximo</span>
        </button>
      </div>
    `;

    const carouselContainer = document.createElement('div');
    carouselContainer.innerHTML = titleHtml;
    section.appendChild(carouselContainer);

    const inner = carouselContainer.querySelector('.carousel-inner');

    const PRODUCTS_PER_SLIDE = 4;
    
    // Criar slides
    for (let i = 0; i < category.itens.length; i += PRODUCTS_PER_SLIDE) {
      const carouselItem = document.createElement('div');
      carouselItem.classList.add('carousel-item');
      if (i === 0) carouselItem.classList.add('active');

      const row = document.createElement('div');
      row.className = 'row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4';

      const slideItems = category.itens.slice(i, i + PRODUCTS_PER_SLIDE);

      slideItems.forEach(product => {
        const col = document.createElement('div');
        col.classList.add('col');
        col.innerHTML = createProductCard(product);
        row.appendChild(col);
      });

      carouselItem.appendChild(row);
      inner.appendChild(carouselItem);
    }

    return section;
  };

  /**
   * Renderiza produtos em grid para homepage
   */
  const renderProductsHome = (productsData) => {
    const container = document.getElementById('vitrine');
    if (!container) return;

    container.innerHTML = '';
    container.className = 'products-grid';

    // Pegar apenas os primeiros 8 produtos de todas as categorias
    let allProducts = [];
    if (Array.isArray(productsData)) {
      productsData.forEach(category => {
        if (category.itens && Array.isArray(category.itens)) {
          allProducts = allProducts.concat(category.itens);
        }
      });
    }

    // Limitar a 8 produtos para a homepage
    const limitedProducts = allProducts.slice(0, 8);

    if (limitedProducts.length === 0) {
      container.innerHTML = '<p style="grid-column: 1/-1; text-align: center; padding: 40px; color: #999;">Carregando produtos...</p>';
      return;
    }

    limitedProducts.forEach(product => {
      const card = document.createElement('div');
      card.innerHTML = createProductCardHome(product);
      container.appendChild(card.firstElementChild);
    });

    attachProductListeners();
  };

  /**
   * Renderiza todos os produtos na vitrine (layout de carrossel)
   */
  const renderProducts = (productsData) => {
    const container = document.getElementById('vitrine');
    if (!container) return;

    container.innerHTML = '';

    productsData.forEach(category => {
      const carouselSection = createCarouselSection(category);
      container.appendChild(carouselSection);
    });

    // Inicializar carrosséis do Bootstrap
    initializeCarousels();
  };

  /**
   * Inicializa os carrosséis do Bootstrap
   */
  const initializeCarousels = () => {
    const carousels = document.querySelectorAll('.carousel');
    carousels.forEach(carouselEl => {
      const carousel = new bootstrap.Carousel(carouselEl, {
        interval: false,
        wrap: false,
        keyboard: false
      });

      // Remover listeners de teclado automáticos
      carouselEl.removeEventListener('keydown.bs.carousel');
    });
  };

  /**
   * Anexa listeners aos elementos de produtos
   */
  const attachProductListeners = () => {
    // Botões de comprar
    document.querySelectorAll('.btn-buy').forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        const productId = btn.getAttribute('data-product-id');
        console.log('Adicionando produto ao carrinho:', productId);
        // TODO: Implementar lógica de carrinho
      });
    });

    // Botões de favorito
    document.querySelectorAll('.product-favorite').forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        btn.classList.toggle('active');
        btn.querySelector('i').classList.toggle('bi-heart');
        btn.querySelector('i').classList.toggle('bi-heart-fill');
      });
    });

    // Links de produtos
    document.querySelectorAll('.product-card a').forEach(link => {
      if (link.classList.contains('card-link')) {
        link.addEventListener('click', () => {
          const href = link.getAttribute('href');
          window.location.href = href;
        });
      }
    });
  };

  /**
   * Busca produtos da API
   */
  const fetchProducts = async () => {
    try {
      const response = await fetch(API_ENDPOINT + '?t=' + Date.now());

      if (!response.ok) {
        throw new Error(`Erro HTTP: ${response.status}`);
      }

      const data = await response.json();

      // Se a API retornar dados válidos
      if (Array.isArray(data) && data.length > 0) {
        return data;
      }

      console.error('API retornou dados vazios.');
      return [];
    } catch (error) {
      console.error('Erro ao buscar produtos:', error);
      return [];
    }
  };

  /**
   * Inicializa o gerenciador de produtos
   */
  const init = async () => {
    let products = await fetchProducts();
    
    // Se a API não retornar produtos, usar dados padrão
    if (!products || products.length === 0) {
      console.log('Usando dados padrão de produtos...');
      products = ProductsData.getDefault();
    }
    
    // Se estamos na homepage, renderizar produtos para vitrine
    const container = document.getElementById('vitrine');
    if (container) {
      renderProductsHome(products);
    }
  };

  return {
    init,
    renderProducts,
    renderProductsHome,
    fetchProducts,
    attachProductListeners
  };
})();

// Inicializar quando o DOM estiver pronto
document.addEventListener('DOMContentLoaded', () => {
  ProductManager.init();
});
