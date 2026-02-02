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

// Fallback array is now loaded from js/fallback-products.js
// Ensure that file is included in your HTML before this script.

async function fetchProductsFromDatabase() {
    try {
        // Busca os dados da nova rota de API configurada no router.php
        const response = await fetch('/api/vitrine');

        if (!response.ok) {
            throw new Error(`Erro HTTP: ${response.status}`);
        }

        const produtosDoBD = await response.json();

        // Se a API retornar um JSON vazio (sem produtos)
        if (!Array.isArray(produtosDoBD) || produtosDoBD.length === 0) {
            console.warn("API retornou dados vazios. Usando array local.");
            return typeof ProductsData !== 'undefined' ? ProductsData.getDefault() : [];
        }

        return produtosDoBD;

    } catch (error) {
        console.error("Falha ao conectar com a API PHP. Usando array local como fallback.", error);
        // Em caso de falha, usa o array global definido no outro arquivo
        return typeof ProductsData !== 'undefined' ? ProductsData.getDefault() : [];
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