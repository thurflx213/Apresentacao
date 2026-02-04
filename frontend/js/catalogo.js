/**
 * Gerenciador da Página de Catálogo
 * Completo com filtros, ordenação e paginação
 */

const CatalogManager = (() => {
    const API_ENDPOINT = '/api/vitrine.php';
    let allProducts = [];
    let filteredProducts = [];
    let currentPage = 1;
    const productsPerPage = 12;

    // Estado dos filtros
    const filterState = {
        categories: [],
        sizes: [],
        colors: [],
        priceRange: [0, 1000]
    };

    /**
     * Inicializa o catálogo
     */
    const init = async () => {
        // Busca produtos
        allProducts = await fetchProducts();
        filteredProducts = [...allProducts];

        // Setup de filtros
        setupFilters();

        // Renderiza
        applyFilters();
    };

    /**
     * Busca produtos da API
     */
    const fetchProducts = async () => {
        try {
            const response = await fetch(API_ENDPOINT);
            if (!response.ok) throw new Error('Erro na API');
            const data = await response.json();

            if (Array.isArray(data) && data.length > 0) {
                return data;
            }

            console.error('API retornou lista vazia ou inválida.');
            return [];
        } catch (e) {
            console.error('Erro ao carregar catálogo:', e);
            return [];
        }
    };

    /**
     * Transforma a lista de categorias em lista de itens
     */
    const flattenProducts = (categories) => {
        let items = [];
        categories.forEach(cat => {
            if (cat.itens && Array.isArray(cat.itens)) {
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
     * Aplica filtros aos produtos
     */
    const applyFilters = () => {
        let products = [...allProducts];

        // Flatten para pegar todos os itens
        const flatProducts = flattenProducts(products);

        // Filtro de categorias
        if (filterState.categories.length > 0) {
            filteredProducts = flatProducts.filter(prod => 
                filterState.categories.includes(prod.categoriaOrigem)
            );
        } else {
            filteredProducts = flatProducts;
        }

        // Filtro de preço
        filteredProducts = filteredProducts.filter(prod => 
            prod.preco >= filterState.priceRange[0] && 
            prod.preco <= filterState.priceRange[1]
        );

        // Reseta paginação ao aplicar filtros
        currentPage = 1;

        // Renderiza
        renderCatalog();
        updatePagination();
    };

    /**
     * Renderiza o grid de produtos com paginação
     */
    const renderCatalog = () => {
        const container = document.getElementById('vitrine-catalogo');
        if (!container) return;

        // Limpa conteúdo
        container.innerHTML = '';

        // Calcula índices para paginação
        const totalProducts = filteredProducts.length;
        const startIdx = (currentPage - 1) * productsPerPage;
        const endIdx = Math.min(startIdx + productsPerPage, totalProducts);
        const paginated = filteredProducts.slice(startIdx, endIdx);

        // Atualiza contador
        const countEl = document.querySelector('.mb-5 .small b');
        if (countEl) countEl.textContent = totalProducts;

        // Se não há produtos
        if (paginated.length === 0) {
            container.innerHTML = '<div class="col-12 text-center py-5"><p class="text-secondary">Nenhum produto encontrado com esses filtros.</p></div>';
            return;
        }

        // Renderiza produtos
        paginated.forEach(prod => {
            const html = createCatalogCard(prod);
            const col = document.createElement('div');
            col.className = 'col-6 col-lg-4 col-xl-3';
            col.innerHTML = html;
            container.appendChild(col);
        });

        // Adiciona event listeners aos botões
        addProductEventListeners();
    };

    /**
     * Cria o HTML do card para o catálogo
     */
    const createCatalogCard = (prod) => {
        const precoFormatado = prod.preco.toFixed(2).replace('.', ',');
        const precoOriginal = (prod.preco * 1.2).toFixed(2).replace('.', ',');
        const imgSrc = normalizeImagePath(prod.img);
        const webpSrc = getWebpPath(imgSrc);

        return `
        <div class="product-card">
            <div class="product-img-box">
                ${prod.oferta ? `<span class="p-badge gold">${prod.oferta}</span>` : ''}
                ${prod.desconto ? `<span class="p-badge white">${prod.desconto}</span>` : ''}
                <a href="produto.html?id=${prod.id}">
                    <picture>
                        <source srcset="${webpSrc}" type="image/webp">
                        <img src="${imgSrc}" class="img-main" alt="${prod.nome}" loading="lazy">
                    </picture>
                </a>
                <div class="product-actions">
                    <button class="btn-heart" title="Favoritar" data-product-id="${prod.id}">
                        <i class="bi bi-heart"></i>
                    </button>
                    <button class="btn-add-cart" title="Adicionar ao Carrinho" data-product-id="${prod.id}" data-product-name="${prod.nome}" data-product-price="${prod.preco}">
                        <i class="bi bi-bag-plus"></i>
                    </button>
                </div>
            </div>
            <div class="product-details">
                <p class="category">${prod.categoriaOrigem || 'Geral'}</p>
                <h3 class="name"><a href="produto.html?id=${prod.id}" class="text-white text-decoration-none">${prod.nome}</a></h3>
                <div class="rating">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    <span class="text-secondary small">(156)</span>
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

    /**
     * Atualiza a paginação
     */
    const updatePagination = () => {
        const totalPages = Math.ceil(filteredProducts.length / productsPerPage);
        const paginationContainer = document.querySelector('.pagination-premium');
        
        if (!paginationContainer) return;

        // Limpa
        paginationContainer.innerHTML = '';

        // Botão anterior
        const prevLi = document.createElement('li');
        prevLi.innerHTML = `<a href="#" class="prev" ${currentPage === 1 ? 'disabled' : ''}><i class="bi bi-arrow-left"></i></a>`;
        prevLi.addEventListener('click', (e) => {
            e.preventDefault();
            if (currentPage > 1) {
                currentPage--;
                renderCatalog();
                updatePagination();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        });
        paginationContainer.appendChild(prevLi);

        // Números de página
        let startPage = Math.max(1, currentPage - 2);
        let endPage = Math.min(totalPages, currentPage + 2);

        if (startPage > 1) {
            const firstLi = document.createElement('li');
            firstLi.innerHTML = '<a href="#">01</a>';
            firstLi.addEventListener('click', (e) => {
                e.preventDefault();
                currentPage = 1;
                renderCatalog();
                updatePagination();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
            paginationContainer.appendChild(firstLi);

            if (startPage > 2) {
                const dotsLi = document.createElement('li');
                dotsLi.innerHTML = '<span>...</span>';
                paginationContainer.appendChild(dotsLi);
            }
        }

        for (let i = startPage; i <= endPage; i++) {
            const li = document.createElement('li');
            const link = document.createElement('a');
            link.href = '#';
            link.textContent = String(i).padStart(2, '0');
            if (i === currentPage) link.classList.add('active');
            
            link.addEventListener('click', (e) => {
                e.preventDefault();
                currentPage = i;
                renderCatalog();
                updatePagination();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
            
            li.appendChild(link);
            paginationContainer.appendChild(li);
        }

        if (endPage < totalPages) {
            if (endPage < totalPages - 1) {
                const dotsLi = document.createElement('li');
                dotsLi.innerHTML = '<span>...</span>';
                paginationContainer.appendChild(dotsLi);
            }

            const lastLi = document.createElement('li');
            const lastPageFormatted = String(totalPages).padStart(2, '0');
            lastLi.innerHTML = `<a href="#">${lastPageFormatted}</a>`;
            lastLi.addEventListener('click', (e) => {
                e.preventDefault();
                currentPage = totalPages;
                renderCatalog();
                updatePagination();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
            paginationContainer.appendChild(lastLi);
        }

        // Botão próximo
        const nextLi = document.createElement('li');
        nextLi.innerHTML = `<a href="#" class="next" ${currentPage === totalPages ? 'disabled' : ''}><i class="bi bi-arrow-right"></i></a>`;
        nextLi.addEventListener('click', (e) => {
            e.preventDefault();
            if (currentPage < totalPages) {
                currentPage++;
                renderCatalog();
                updatePagination();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        });
        paginationContainer.appendChild(nextLi);
    };

    /**
     * Setup de filtros e eventos
     */
    const setupFilters = () => {
        // Filtros de categorias
        document.querySelectorAll('#collapseCat input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('change', (e) => {
                const categoryName = e.target.parentElement.textContent.trim();
                if (e.target.checked) {
                    filterState.categories.push(categoryName);
                } else {
                    filterState.categories = filterState.categories.filter(c => c !== categoryName);
                }
                applyFilters();
            });
        });

        // Filtro de preço
        const rangeInput = document.getElementById('rangePreco');
        if (rangeInput) {
            rangeInput.addEventListener('input', (e) => {
                filterState.priceRange[1] = parseInt(e.target.value);
                document.querySelector('.gold-text.fw-bold').textContent = `R$ ${filterState.priceRange[1]}`;
                applyFilters();
            });
        }

        // Botão limpar filtros
        const clearBtn = document.querySelector('.filter-header .btn-sm');
        if (clearBtn) {
            clearBtn.addEventListener('click', () => {
                filterState.categories = [];
                filterState.sizes = [];
                filterState.colors = [];
                filterState.priceRange = [0, 1000];

                // Reseta checkboxes
                document.querySelectorAll('#collapseCat input[type="checkbox"]').forEach(cb => cb.checked = false);
                document.getElementById('rangePreco').value = 1000;
                document.querySelector('.gold-text.fw-bold').textContent = 'R$ 1.000';

                applyFilters();
            });
        }

        // Ordenação
        const sortSelect = document.querySelector('.sort-select');
        if (sortSelect) {
            sortSelect.addEventListener('change', (e) => {
                const option = e.target.value;
                sortProducts(option);
            });
        }
    };

    /**
     * Ordena produtos
     */
    const sortProducts = (option) => {
        if (option.includes('Menor Preço')) {
            filteredProducts.sort((a, b) => a.preco - b.preco);
        } else if (option.includes('Maior Preço')) {
            filteredProducts.sort((a, b) => b.preco - a.preco);
        } else if (option.includes('Mais Vendidos')) {
            // Mantém ordem original (seria necessário dados adicionais)
        } else {
            // Mais Recentes
            filteredProducts.reverse();
        }
        currentPage = 1;
        renderCatalog();
        updatePagination();
    };

    /**
     * Adiciona event listeners aos botões dos produtos
     */
    const addProductEventListeners = () => {
        // Botões de favoritar
        document.querySelectorAll('.btn-heart').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                btn.classList.toggle('favorited');
                const productId = btn.dataset.productId;
                saveFavorite(productId);
            });
        });

        // Botões de adicionar ao carrinho
        document.querySelectorAll('.btn-add-cart').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const productId = btn.dataset.productId;
                const productName = btn.dataset.productName;
                const productPrice = parseFloat(btn.dataset.productPrice);
                addToCart(productId, productName, productPrice);
            });
        });
    };

    /**
     * Salva favorito no localStorage
     */
    const saveFavorite = (productId) => {
        let favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
        if (favorites.includes(productId)) {
            favorites = favorites.filter(id => id !== productId);
        } else {
            favorites.push(productId);
        }
        localStorage.setItem('favorites', JSON.stringify(favorites));
    };

    /**
     * Adiciona produto ao carrinho
     */
    const addToCart = (productId, productName, productPrice) => {
        let cart = JSON.parse(localStorage.getItem('cart') || '[]');
        const existingItem = cart.find(item => item.id === productId);

        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            cart.push({
                id: productId,
                name: productName,
                price: productPrice,
                quantity: 1,
                size: 'M',
                color: 'Preto'
            });
        }

        localStorage.setItem('cart', JSON.stringify(cart));
        alert(`${productName} adicionado ao carrinho!`);
    };

    /**
     * Converte caminho de imagem para WebP
     */
    const getWebpPath = (path) => {
        if (!path) return path;
        return path.replace(/\.(jpg|jpeg|png)$/i, '.webp');
    };

    /**
     * Normaliza caminho de imagem
     */
    const normalizeImagePath = (path) => {
        if (!path) return path;
        if (path.startsWith('../') || path.startsWith('http://') || path.startsWith('https://')) return path;
        if (path.startsWith('img/')) return `../${path}`;
        return path;
    };

    return { init };
})();

document.addEventListener('DOMContentLoaded', CatalogManager.init);