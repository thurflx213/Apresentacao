/**
 * Gerenciador da Página de Catálogo
 */

const CatalogManager = (() => {
    const API_ENDPOINT = '/api/vitrine';
    let allProducts = [];

    /**
     * Inicializa o catálogo
     */
    const init = async () => {
        // Busca produtos
        allProducts = await fetchProducts();

        // Flatten a estrutura de categorias para uma lista única de produtos
        const flatProducts = flattenProducts(allProducts);

        // Renderiza
        renderCatalog(flatProducts);

        // Setup de filtros (placeholder para futura implementação)
        setupFilters();
    };

    /**
     * Busca produtos da API
     */
    const fetchProducts = async () => {
        try {
            const response = await fetch(API_ENDPOINT);
            if (!response.ok) throw new Error('Erro na API');
            const data = await response.json();

            if (Array.isArray(data) && data.length > 0) return data;

            console.warn('Usando fallback para catálogo');
            return ProductsData.getDefault();
        } catch (e) {
            console.error('Erro ao carregar catálogo:', e);
            return ProductsData.getDefault();
        }
    };

    /**
     * Transforma a lista de categorias em lista de itens
     */
    const flattenProducts = (categories) => {
        let items = [];
        categories.forEach(cat => {
            if (cat.itens && Array.isArray(cat.itens)) {
                // Adiciona a categoria ao item se não tiver
                const itemsWithCat = cat.itens.map(item => ({
                    ...item,
                    categoriaOrigem: cat.categoria
                }));
                items = items.concat(itemsWithCat);
            }
        });
        return items;
    };

    /**
     * Renderiza o grid de produtos
     */
    const renderCatalog = (products) => {
        const container = document.getElementById('vitrine-catalogo');
        if (!container) return;

        // Limpa conteúdo estático
        container.innerHTML = '';

        // Atualiza contador
        const countEl = document.querySelector('.mb-5 .small b');
        if (countEl) countEl.textContent = products.length;

        products.forEach(prod => {
            const html = createCatalogCard(prod);
            const col = document.createElement('div');
            col.className = 'col-6 col-lg-4 col-xl-3';
            col.innerHTML = html;
            container.appendChild(col);
        });
    };

    /**
     * Cria o HTML do card para o catálogo (estilo similar ao HTML original)
     */
    const createCatalogCard = (prod) => {
        const precoFormatado = prod.preco.toFixed(2).replace('.', ',');
        const precoOriginal = (prod.preco * 1.2).toFixed(2).replace('.', ','); // Simula preço antigo

        return `
        <div class="product-card">
            <div class="product-img-box">
                ${prod.oferta ? `<span class="p-badge gold">${prod.oferta}</span>` : ''}
                ${prod.desconto ? `<span class="p-badge white">${prod.desconto}</span>` : ''}
                <div class="quick-view">Visualização Rápida</div>
                <a href="produto.html?id=${prod.id}">
                    <img src="${prod.img}" class="img-main" alt="${prod.nome}" loading="lazy">
                </a>
                <div class="product-actions">
                    <button title="Favoritar"><i class="bi bi-heart"></i></button>
                    <button title="Adicionar ao Carrinho"><i class="bi bi-bag-plus"></i></button>
                </div>
            </div>
            <div class="product-details">
                <p class="category">${prod.categoriaOrigem || 'Geral'}</p>
                <h3 class="name"><a href="produto.html?id=${prod.id}" class="text-white text-decoration-none">${prod.nome}</a></h3>
                <div class="rating">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <div class="price-box">
                    <span class="old-price">R$ ${precoOriginal}</span>
                    <span class="current-price">R$ ${precoFormatado}</span>
                </div>
                <button class="btn-buy-now" onclick="window.location.href='produto.html?id=${prod.id}'">COMPRAR AGORA</button>
            </div>
        </div>
      `;
    };

    const setupFilters = () => {
        // Implementação futura: conectar os checkboxes do sidebar com a filtragem
    };

    return { init };
})();

document.addEventListener('DOMContentLoaded', CatalogManager.init);