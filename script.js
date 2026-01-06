window.addEventListener("scroll", () => {
  const navbar = document.getElementById("navbar");

  if (window.scrollY > 50) {
    navbar.classList.add("scrolled");
  } else {
    navbar.classList.remove("scrolled");
  }
});

const faqs = document.querySelectorAll(".faq-question");
faqs.forEach((btn) => {
    btn.addEventListener("click", () => {
        const parent = btn.parentElement;
        parent.classList.toggle("open");
    });
});

const produtosArrayLocal = [
    {
        categoria: "CAMISETAS",
        tag: "NOVA COLEÇÃO", // Removendo espaços duplicados na tag
        itens: [
            
            { id: "camiseta1", nome: "CAMISETA OVERSIZED - FACE", preco: 129.90, img: "img/comp-polo-branca-frente.webp", alt: "Camiseta preta face", parcelas: 21.65, desconto: "-21%" },
            { id: "camiseta2", nome: "CAMISETA OVERSIZED - LAST", preco: 129.90, img: "img/camiseta branca.png", alt: "Camiseta branca last", parcelas: 21.65, oferta: "3 POR 199" },
            { id: "camiseta3", nome: "CAMISETA OVERSIZED - ONLY", preco: 129.90, img: "img/CAMISETA MARROM.png", alt: "Camiseta preta only", parcelas: 21.65, desconto: "-21%" },
            { id: "camiseta4", nome: "CAMISETA OVERSIZED - FELINE", preco: 129.90, img: "img/camiseta off white.png", alt: "Camiseta off white felina", parcelas: 21.65, oferta: "3 POR 199" },
            { id: "camiseta5", nome: "CAMISETA OVERSIZED - STREET", preco: 100.00, img: "img/camise preta street.png", alt: "Camiseta preta essence", parcelas: 16.67 },
            { id: "camiseta6", nome: "CAMISETA OVERSIZED - JERSEY", preco: 220.00, img: "img/camiseta-jersey-comp-26.webp", alt: "Camiseta branca street", parcelas: 3.33 },
            { id: "camiseta7", nome: "CAMISETA OVERSIZED - JERSEY", preco: 220.00, img: "img/camiseta-jersey-comp-26.webp", alt: "Camiseta branca street", parcelas: 3.33 },
            { id: "camiseta8", nome: "CAMISETA OVERSIZED - JERSEY", preco: 220.00, img: "img/camiseta-jersey-comp-26.webp", alt: "Camiseta branca street", parcelas: 3.33 },
        ]
    },
    {
        categoria: "BLUSAS",
        tag: "MOLETOM E HOODIES",
        itens: [
            { id: "blusa1", nome: "ZIP UP - FREEDOMA", preco: 180.00, img: "img/moletom.png", alt: "Blusa branca zip up", parcelas: 30.00 },
            { id: "blusa2", nome: "MOLETOM GOLA CARECA - FACE", preco: 180.00, img: "img/moletom 2.png", alt: "Blusa preta face", parcelas: 30.00 },
            { id: "blusa3", nome: "MOLETOM GOLA CARECA - LOGO", preco: 180.00, img: "img/moletom 3.png", alt: "Blusa creme logo", parcelas: 30.00 },
            { id: "blusa4", nome: "CASACO MOLETOM OVERSIZED", preco: 180.00, img: "img/moletom 4.png", alt: "Casaco branco oversized", parcelas: 30.00 },
            { id: "blusa5", nome: "MOLETOM COM CAPUZ - CLASSIC", preco: 159.90, img: "img/moletom.png", alt: "Blusa preta classic", parcelas: 26.65, desconto: "-10%" },
            { id: "blusa6", nome: "MOLETOM - CLASSIC", preco: 159.90, img: "img/moletom.png", alt: "Blusa preta classic", parcelas: 26.65, desconto: "-10%" },
            { id: "blusa7", nome: "MOLETOM - CLASSIC", preco: 159.90, img: "img/moletom.png", alt: "Blusa preta classic", parcelas: 26.65, desconto: "-10%" },
            { id: "blusa8", nome: "MOLETOM - CLASSIC", preco: 159.90, img: "img/moletom.png", alt: "Blusa preta classic", parcelas: 26.65, desconto: "-10%" },
        ]
    },
    {
        categoria: "CALÇAS",
        tag: "JEANS E MOLETOM",
        itens: [
            { id: "calca1", nome: "CALÇA DE MOLETOM - FREEDOM", preco: 200.00, img: "img/carca.png", alt: "Calça de moletom cinza", parcelas: 33.33 },
            { id: "calca2", nome: "CALÇA SKINNY - BLUE", preco: 200.00, img: "img/calça 2.png", alt: "Calça jeans azul skinny", parcelas: 33.33 },
            { id: "calca3", nome: "CALÇA SARJA - BLACK", preco: 200.00, img: "img/calça 3.png", alt: "Calça sarja preta", parcelas: 33.33 },
            { id: "calca4", nome: "CALÇA Y2K - BAGGY", preco: 200.00, img: "img/calça 4.png", alt: "Calça jeans larga baggy", parcelas: 33.33, oferta: "NOVIDADE" },
            { id: "calca5", nome: "CALÇA SARJA BEGE", preco: 139.90, img: "img/calça 3.png", alt: "Calça sarja bege slim", parcelas: 23.32 },
            { id: "calca6", nome: "CALÇA Y2K - BAGGY", preco: 200.00, img: "img/calça 4.png", alt: "Calça jeans larga baggy", parcelas: 33.33, oferta: "NOVIDADE" },
            { id: "calca7", nome: "CALÇA SARJA ", preco: 139.90, img: "img/calça 3.png", alt: "Calça sarja bege slim", parcelas: 23.32 },
            { id: "calca8", nome: "CALÇA SARJA ", preco: 139.90, img: "img/calça 3.png", alt: "Calça sarja bege slim", parcelas: 23.32 },
        ]
    },
    {
        categoria: "SAPATOS",
        tag: "SNEAKERS E CASUAIS",
        itens: [
            { id: "sapato1", nome: "Tênis Nike Air Max Dn Feminino", preco: 250.00, img: "img/dn.png", alt: "Sapato casual", parcelas: 41.67 },
            { id: "sapato2", nome: "Air Max DN - Vermelho", preco: 250.00, img: "img/dn vermelho.png", alt: "Sapato casual vermelho", parcelas: 41.67, desconto: "-15%" },
            { id: "sapato3", nome: "Tênis Nike Air Max Dn Masculino", preco: 250.00, img: "img/dn branco 3232.png", alt: "Sapato casual branco", parcelas: 41.67 },
            { id: "sapato4", nome: "Tênis Nike Air Max Plus Drift", preco: 250.00, img: "img/TN.png", alt: "Sapato casual", parcelas: 41.67, oferta: "LANÇAMENTO" },
            { id: "sapato5", nome: "Tênis Nike Air Max Dn Feminino", preco: 250.00, img: "img/dn.png", alt: "Sapato casual", parcelas: 41.67 },
            { id: "sapato6", nome: "Air Max DN - Vermelho", preco: 250.00, img: "img/dn vermelho.png", alt: "Sapato casual vermelho", parcelas: 41.67, desconto: "-15%" },
            { id: "sapato7", nome: "Tênis Nike Air Max Dn Masculino", preco: 250.00, img: "img/dn branco 3232.png", alt: "Sapato casual branco", parcelas: 41.67 },
            { id: "sapato8", nome: "Tênis Nike Air Max Plus Drift", preco: 250.00, img: "img/TN.png", alt: "Sapato casual", parcelas: 41.67, oferta: "LANÇAMENTO" },
        ]
    },
    {
        categoria: "CAMISAS - POLO",
        tag: "CLÁSSICOS",
        itens: [
            { id: "polo1", nome: "Camisa Polo Nike Court Dri-FIT", preco: 80.00, img: "img/polo .png", alt: "Polo azul marinho", parcelas: 13.33 },
            { id: "polo2", nome: "Camisa Polo Nike Court Dri-FIT", preco: 80.00, img: "img/polo 2.png", alt: "Polo branca", parcelas: 13.33 },
            { id: "polo3", nome: "Camisa Polo Nike Court Dri-FIT", preco: 80.00, img: "img/polo 3.png", alt: "Polo preta", parcelas: 13.33 },
            { id: "polo4", nome: "Camisa Polo Nike Court Dri-FIT", preco: 80.00, img: "img/polo .png", alt: "Polo verde", parcelas: 13.33 },
            { id: "polo5", nome: "Camisa Polo Nike Court Dri-FIT", preco: 80.00, img: "img/polo .png", alt: "Polo azul marinho", parcelas: 13.33 },
            { id: "polo6", nome: "Camisa Polo Nike Court Dri-FIT", preco: 80.00, img: "img/polo .png", alt: "Polo branca", parcelas: 13.33 },
            { id: "polo7", nome: "Camisa Polo Nike Court Dri-FIT", preco: 80.00, img: "img/polo .png", alt: "Polo preta", parcelas: 13.33 },
            { id: "polo8", nome: "Camisa Polo Nike Court Dri-FIT", preco: 80.00, img: "img/polo .png", alt: "Polo verde", parcelas: 13.33 },
        ]
    }
];

function createProductCard(prod) {
    const precoFormatado = prod.preco.toFixed(2).replace('.', ',');
    const parcelasFormatadas = (prod.parcelas ? prod.parcelas : (prod.preco / 6)).toFixed(2).replace('.', ',');
    
    let badges = '';
    if (prod.desconto) {
        badges += `<span class="badge sale-badge">${prod.desconto}</span>`;
    }
    if (prod.oferta) {
        badges += `<span class="badge sale-badge-alt">${prod.oferta}</span>`;
    }

    return `
        <div class="product-card">
            ${badges ? `<div class="card-badges">${badges}</div>` : ''}
            <a href="produto.html?id=${prod.id}" class="card-link">
                <div class="card-img-container">
                    <img src="${prod.img}" class="card-main-img" alt="${prod.alt}">
                </div>
                <div class="card-body">
                    <h3 class="card-title">${prod.nome}</h3>
                    <div class="price-info">
                        <p class="card-text main-price">R$ ${precoFormatado}</p>
                        <p class="card-installments">ou 6x de R$ ${parcelasFormatadas} sem juros</p>
                    </div>
                </div>
            </a>
            <div class="card-actions">
                <button class="btn btn-quick-buy"><i class="bi bi-cart-plus"></i> Comprar</button>
            </div>
        </div>
    `;
}

function createCarouselSection(secao) {
    const section = document.createElement("section");
    section.classList.add("mb-5", "mt-5");

      const tituloHtml = `
      <h2 class="h2-titulo text-center mb-1">${secao.categoria}</h2>
      ${secao.tag ? `<p class="text-center mb-4 category-tag">${secao.tag}</p>` : ''}
    `;
    section.innerHTML = tituloHtml;

    const carouselId = `carousel-${secao.categoria.replace(/\s/g, '-')}`;
    const carouselHtml = `
        <div id="${carouselId}" class="carousel slide" data-bs-ride="false" data-bs-interval="false">
            <div class="carousel-inner">
            </div>
            ${secao.itens.length > 4 ? `
                <button class="carousel-control-prev" type="button" data-bs-target="#${carouselId}" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#${carouselId}" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Próximo</span>
                </button>
            ` : ''}
        </div>
    `;
    const carouselContainer = document.createElement('div');
    carouselContainer.innerHTML = carouselHtml;
    section.appendChild(carouselContainer);

    const inner = carouselContainer.querySelector('.carousel-inner');
    const productsPerSlide = 4;

    for (let i = 0; i < secao.itens.length; i += productsPerSlide) {
        const carouselItem = document.createElement('div');
        carouselItem.classList.add('carousel-item');
        if (i === 0) carouselItem.classList.add('active'); 

        const row = document.createElement('div');
        row.className = 'row row-cols-2 row-cols-md-4 g-4'; 

        const slideItems = secao.itens.slice(i, i + productsPerSlide);

        slideItems.forEach(prod => {
            const col = document.createElement('div');
            col.classList.add('col');
            col.innerHTML = createProductCard(prod); 
            row.appendChild(col);
        });

        carouselItem.appendChild(row);
        inner.appendChild(carouselItem);
    }
    
    return section;
}

function renderProducts(produtosData) {
    const container = document.getElementById("vitrine");
    container.innerHTML = ''; 
    
    produtosData.forEach(secao => {
        const carouselSection = createCarouselSection(secao);
        container.appendChild(carouselSection);
    });
}

async function fetchProductsFromDatabase() {
    try {
        // Tenta buscar os dados do novo endpoint PHP
        const response = await fetch('/api/vitrine'); 
        
        if (!response.ok) {
            throw new Error(`Erro HTTP: ${response.status}`);
        }
        
        const produtosDoBD = await response.json();
        
        // Se a API retornar um JSON vazio (sem produtos)
        if (!Array.isArray(produtosDoBD) || produtosDoBD.length === 0) {
            console.warn("API retornou dados vazios. Usando array local.");
            return produtosArrayLocal;
        }
        
        return produtosDoBD;

    } catch (error) {
        console.error("Falha ao conectar com a API PHP. Usando array local como fallback.", error);
        // Em caso de falha, o site continua funcionando com os dados estáticos
        return produtosArrayLocal; 
    }
}

document.addEventListener('DOMContentLoaded', async () => {
    const produtos = await fetchProductsFromDatabase();
    renderProducts(produtos);

    const carousels = document.querySelectorAll('.carousel');
    carousels.forEach(carouselEl => {
        if (carouselEl.id.startsWith('carousel-')) {
            new bootstrap.Carousel(carouselEl, {
                interval: false,
                wrap: true 
            });
        }
    });
});