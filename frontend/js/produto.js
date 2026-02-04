/**
 * Gerenciador da Página de Detalhes do Produto
 */

const ProductDetailManager = (() => {
    const API_ENDPOINT = '/api/vitrine.php';
    let currentProduct = null;
    let selectedSize = 'M';
    let selectedColor = 'Preto';
    let quantity = 1;

    /**
     * Inicializa a página
     */
    const init = async () => {
        const productId = getProductIdFromURL();
        
        if (!productId) {
            showError('Produto não encontrado.');
            return;
        }

        const product = await fetchProductData(productId);
        
        if (!product) {
            showError('Não foi possível carregar os dados do produto.');
            return;
        }

        currentProduct = product;
        renderProduct(product);
        setupEventListeners();
        loadRelatedProducts(product.categoriaOrigem);
        updateCartCount();
    };

    /**
     * Obtém ID do produto da URL
     */
    const getProductIdFromURL = () => {
        const params = new URLSearchParams(window.location.search);
        return params.get('id');
    };

    /**
     * Busca dados do produto da API
     */
    const fetchProductData = async (productId) => {
        try {
            const response = await fetch(API_ENDPOINT);
            if (!response.ok) throw new Error('Erro na API');
            const categoriesData = await response.json();

            // Procura pelo produto entre todas as categorias
            for (let category of categoriesData) {
                if (category.itens && Array.isArray(category.itens)) {
                    const product = category.itens.find(item => item.id == productId);
                    if (product) {
                        return {
                            ...product,
                            categoriaOrigem: category.categoria
                        };
                    }
                }
            }

            return null;
        } catch (e) {
            console.error('Erro ao buscar produto:', e);
            return null;
        }
    };

    /**
     * Renderiza os detalhes do produto
     */
    const renderProduct = (product) => {
        // Nome e categoria
        document.getElementById('product-name').textContent = product.nome;
        document.getElementById('product-category').textContent = product.categoriaOrigem || 'Geral';

        // Preço
        const precoFormatado = formatPrice(product.preco);
        const precoOriginal = (product.preco * 1.2).toFixed(2);
        const precoOriginalFormatado = formatPrice(precoOriginal);
        const discount = Math.round(((precoOriginal - product.preco) / precoOriginal) * 100);

        document.getElementById('price-original').textContent = `R$ ${precoOriginalFormatado}`;
        document.getElementById('price-current').textContent = `R$ ${precoFormatado}`;
        document.getElementById('price-discount').textContent = `${discount}% OFF`;

        // Imagem principal
        const imagePath = normalizeImagePath(product.img);
        const webpPath = getWebpPath(imagePath);
        
        document.getElementById('main-img-webp').srcset = webpPath;
        document.getElementById('main-image').src = imagePath;
        document.getElementById('main-image').alt = product.nome;

        // Descrição
        document.getElementById('product-description').textContent = 
            product.alt || 'Produto de alta qualidade com excelente acabamento.';

        // Parcelamento
        const parcelas = (product.preco / 6).toFixed(2).replace('.', ',');
        document.getElementById('installment-value').textContent = `R$ ${parcelas}`;

        // Renderiza tamanhos
        renderSizes();

        // Renderiza cores
        renderColors();

        // Marca favorito se estiver salvo
        checkFavorited();
    };

    /**
     * Renderiza seletor de tamanhos
     */
    const renderSizes = () => {
        const sizes = ['P', 'M', 'G', 'GG'];
        const container = document.getElementById('sizes-grid');
        container.innerHTML = '';

        sizes.forEach(size => {
            const btn = document.createElement('button');
            btn.className = 'size-btn';
            if (size === selectedSize) btn.classList.add('active');
            btn.textContent = size;
            btn.addEventListener('click', () => selectSize(size, btn));
            container.appendChild(btn);
        });
    };

    /**
     * Renderiza seletor de cores
     */
    const renderColors = () => {
        const colors = [
            { name: 'Preto', hex: '#000000' },
            { name: 'Branco', hex: '#FFFFFF' },
            { name: 'Azul', hex: '#1E3A8A' }
        ];
        const container = document.getElementById('colors-grid');
        container.innerHTML = '';

        colors.forEach(color => {
            const option = document.createElement('div');
            option.className = 'color-option';
            
            const circle = document.createElement('div');
            circle.className = 'color-circle';
            circle.style.backgroundColor = color.hex;
            circle.style.borderColor = color.hex === '#FFFFFF' ? '#333333' : color.hex;
            if (color.name === selectedColor) circle.classList.add('active');

            const name = document.createElement('span');
            name.className = 'color-name';
            name.textContent = color.name;

            option.appendChild(circle);
            option.appendChild(name);

            option.addEventListener('click', () => selectColor(color.name, circle));
            container.appendChild(option);
        });
    };

    /**
     * Seleciona tamanho
     */
    const selectSize = (size, btn) => {
        selectedSize = size;
        document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
    };

    /**
     * Seleciona cor
     */
    const selectColor = (color, circle) => {
        selectedColor = color;
        document.querySelectorAll('.color-circle').forEach(c => c.classList.remove('active'));
        circle.classList.add('active');
    };

    /**
     * Setup de event listeners
     */
    const setupEventListeners = () => {
        // Quantidade
        document.getElementById('qty-minus').addEventListener('click', () => {
            quantity = Math.max(1, quantity - 1);
            document.getElementById('qty-input').value = quantity;
        });

        document.getElementById('qty-plus').addEventListener('click', () => {
            quantity = Math.min(10, quantity + 1);
            document.getElementById('qty-input').value = quantity;
        });

        document.getElementById('qty-input').addEventListener('change', (e) => {
            quantity = Math.max(1, Math.min(10, parseInt(e.target.value) || 1));
            e.target.value = quantity;
        });

        // Adicionar ao carrinho
        document.getElementById('btn-add-cart').addEventListener('click', addToCart);

        // Favoritar
        document.getElementById('btn-favorite').addEventListener('click', toggleFavorite);

        // Abas
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                switchTab(e.target.dataset.tab);
            });
        });

        // Carousel de miniaturas
        setupThumbnailCarousel();
    };

    /**
     * Setup do carousel de miniaturas
     */
    const setupThumbnailCarousel = () => {
        const prevBtn = document.querySelector('.prev-btn');
        const nextBtn = document.querySelector('.next-btn');
        const container = document.querySelector('.thumbnails-container');

        prevBtn.addEventListener('click', () => {
            container.scrollBy({ left: -100, behavior: 'smooth' });
        });

        nextBtn.addEventListener('click', () => {
            container.scrollBy({ left: 100, behavior: 'smooth' });
        });

        // Criar miniaturas (usando a mesma imagem do produto)
        const thumbnails = document.getElementById('thumbnails');
        const imagePath = normalizeImagePath(currentProduct.img);
        const webpPath = getWebpPath(imagePath);

        // Simula 4 miniaturas (mesma imagem)
        for (let i = 0; i < 4; i++) {
            const thumb = document.createElement('div');
            thumb.className = 'thumbnail';
            if (i === 0) thumb.classList.add('active');

            const img = document.createElement('img');
            img.src = imagePath;
            
            thumb.appendChild(img);
            thumb.addEventListener('click', () => {
                document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
                thumb.classList.add('active');
                document.getElementById('main-image').src = imagePath;
            });

            thumbnails.appendChild(thumb);
        }
    };

    /**
     * Adiciona produto ao carrinho
     */
    const addToCart = () => {
        const cartItem = {
            id: currentProduct.id,
            name: currentProduct.nome,
            price: currentProduct.preco,
            quantity: quantity,
            size: selectedSize,
            color: selectedColor,
            image: currentProduct.img
        };

        let cart = JSON.parse(localStorage.getItem('cart') || '[]');
        const existingItem = cart.find(item => 
            item.id === cartItem.id && 
            item.size === cartItem.size && 
            item.color === cartItem.color
        );

        if (existingItem) {
            existingItem.quantity += quantity;
        } else {
            cart.push(cartItem);
        }

        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartCount();
        
        // Feedback visual
        const btn = document.getElementById('btn-add-cart');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="bi bi-check"></i> Adicionado!';
        btn.style.backgroundColor = 'var(--gold)';
        
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.style.backgroundColor = '';
        }, 2000);
    };

    /**
     * Alterna favorito
     */
    const toggleFavorite = () => {
        let favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
        const btn = document.getElementById('btn-favorite');

        if (favorites.includes(currentProduct.id)) {
            favorites = favorites.filter(id => id !== currentProduct.id);
            btn.classList.remove('favorited');
        } else {
            favorites.push(currentProduct.id);
            btn.classList.add('favorited');
        }

        localStorage.setItem('favorites', JSON.stringify(favorites));
    };

    /**
     * Verifica se produto é favorito
     */
    const checkFavorited = () => {
        let favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
        const btn = document.getElementById('btn-favorite');
        
        if (favorites.includes(currentProduct.id)) {
            btn.classList.add('favorited');
        } else {
            btn.classList.remove('favorited');
        }
    };

    /**
     * Troca abas
     */
    const switchTab = (tabName) => {
        // Desativa abas ativas
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
        document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active'));

        // Ativa a aba selecionada
        event.target.classList.add('active');
        document.querySelector(`[data-tab="${tabName}"]`).classList.add('active');
    };

    /**
     * Carrega produtos relacionados
     */
    const loadRelatedProducts = async (category) => {
        try {
            const response = await fetch(API_ENDPOINT);
            if (!response.ok) throw new Error('Erro na API');
            const categoriesData = await response.json();

            const relatedCategory = categoriesData.find(c => c.categoria === category);
            const products = relatedCategory?.itens || [];

            // Filtra produtos diferentes do atual
            const filtered = products.filter(p => p.id != currentProduct.id).slice(0, 4);

            const container = document.getElementById('related-products');
            container.innerHTML = '';

            filtered.forEach(product => {
                const card = createRelatedCard(product);
                container.appendChild(card);
            });
        } catch (e) {
            console.error('Erro ao carregar produtos relacionados:', e);
        }
    };

    /**
     * Cria card de produto relacionado
     */
    const createRelatedCard = (product) => {
        const card = document.createElement('div');
        card.className = 'related-card';
        card.style.cursor = 'pointer';

        const imagePath = normalizeImagePath(product.img);
        const precoFormatado = formatPrice(product.preco);

        card.innerHTML = `
            <img src="${imagePath}" alt="${product.nome}" class="related-img" loading="lazy">
            <div class="related-info">
                <h3 class="related-name">${product.nome}</h3>
                <p class="related-price">R$ ${precoFormatado}</p>
            </div>
        `;

        card.addEventListener('click', () => {
            window.location.href = `produto.html?id=${product.id}`;
        });

        return card;
    };

    /**
     * Formata preço
     */
    const formatPrice = (price) => {
        return parseFloat(price).toFixed(2).replace('.', ',');
    };

    /**
     * Normaliza caminho de imagem
     */
    const normalizeImagePath = (path) => {
        if (!path) return '../img/default.png';
        if (path.startsWith('../') || path.startsWith('http')) return path;
        if (path.startsWith('img/')) return `../${path}`;
        return `../img/${path}`;
    };

    /**
     * Converte para WebP
     */
    const getWebpPath = (path) => {
        if (!path) return path;
        return path.replace(/\.(jpg|jpeg|png)$/i, '.webp');
    };

    /**
     * Atualiza contador do carrinho
     */
    const updateCartCount = () => {
        let cart = JSON.parse(localStorage.getItem('cart') || '[]');
        const count = cart.reduce((sum, item) => sum + item.quantity, 0);
        document.getElementById('cart-count').textContent = count;
    };

    /**
     * Mostra erro
     */
    const showError = (message) => {
        const main = document.querySelector('main');
        main.innerHTML = `
            <div class="container text-center py-5">
                <h2 class="mb-3">⚠️ ${message}</h2>
                <a href="catalogo.html" class="btn btn-warning mt-3">Voltar ao Catálogo</a>
            </div>
        `;
    };

    return { init };
})();

// Inicializa quando o DOM está pronto
document.addEventListener('DOMContentLoaded', ProductDetailManager.init);
