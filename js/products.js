/**
 * Gerenciador de Produtos e Vitrine
 * Responsável por renderizar e gerenciar a exibição de produtos
 */

const ProductManager = (() => {
  const PRODUCTS_PER_SLIDE = 4;
  const API_ENDPOINT = '/api/vitrine';

  /**
   * Cria o HTML de um card de produto
   */
  const createProductCard = (product) => {
    const precoFormatado = ProductsData.formatPrice(product.preco);
    const parcelasFormatadas = ProductsData.formatPrice(
      product.parcelas || product.preco / 6
    );

    let badges = '';
    if (product.desconto) {
      badges += `<span class="badge sale-badge">${product.desconto}</span>`;
    }
    if (product.oferta) {
      badges += `<span class="badge sale-badge-alt">${product.oferta}</span>`;
    }

    return `
      <div class="product-card">
        <a href="produto.html?id=${product.id}" class="card-link">
          <div class="card-img-container">
            ${badges ? `<div class="card-badges">${badges}</div>` : ''}
            <img 
              src="${product.img}" 
              alt="${product.alt}" 
              class="card-main-img"
              loading="lazy"
            >
          </div>
          <div class="card-body">
            <h5 class="card-title">${product.nome}</h5>
            <div class="price-info">
              <p class="main-price">R$ ${precoFormatado}</p>
              <p class="card-installments">ou 6x de R$ ${parcelasFormatadas}</p>
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
   * Renderiza todos os produtos na vitrine
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
   * Busca produtos da API ou usa dados padrão como fallback
   */
  const fetchProducts = async () => {
    try {
      const response = await fetch(API_ENDPOINT);

      if (!response.ok) {
        throw new Error(`Erro HTTP: ${response.status}`);
      }

      const data = await response.json();

      // Se a API retornar dados válidos
      if (Array.isArray(data) && data.length > 0) {
        return data;
      }

      // Fallback para dados padrão
      console.warn('API retornou dados vazios. Usando dados padrão.');
      return ProductsData.getDefault();
    } catch (error) {
      console.error('Erro ao buscar produtos:', error);
      // Fallback para dados padrão em caso de erro
      return ProductsData.getDefault();
    }
  };

  /**
   * Inicializa o gerenciador de produtos
   */
  const init = async () => {
    const products = await fetchProducts();
    renderProducts(products);
  };

  return {
    init,
    renderProducts,
    fetchProducts
  };
})();

// Inicializar quando o DOM estiver pronto
document.addEventListener('DOMContentLoaded', () => {
  ProductManager.init();
});
