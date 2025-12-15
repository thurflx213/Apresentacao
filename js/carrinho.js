

class CarrinhoManager {
    constructor() {
        this.carrinho = [];
        this.localStorageKey = 'carrinhoKoketsu';
        this.carregarCarrinho();
        this.inicializar();
    }

    carregarCarrinho() {
        const carrinhoSalvo = localStorage.getItem(this.localStorageKey);
        if (carrinhoSalvo) {
            try {
                this.carrinho = JSON.parse(carrinhoSalvo);
            } catch (e) {
                console.error('Erro ao carregar carrinho:', e);
                this.carrinho = [];
            }
        }
    }

    salvarCarrinho() {
        localStorage.setItem(this.localStorageKey, JSON.stringify(this.carrinho));
    }

    adicionarProduto(produto) {
        const { id, nome, preco, imagem, tamanho = 'M', quantidade = 1 } = produto;
        const itemExistente = this.carrinho.find(item => item.id === id && item.tamanho === tamanho);

        if (itemExistente) {
            itemExistente.quantidade += quantidade;
        } else {
            this.carrinho.push({
                id,
                nome,
                preco: parseFloat(preco),
                imagem,
                tamanho,
                quantidade
            });
        }

        this.salvarCarrinho();
        this.atualizarInterface();
        this.mostrarNotificacao(`${nome} adicionado ao carrinho!`);
        return true;
    }

    removerProduto(id, tamanho = null) {
        const index = this.carrinho.findIndex(item => 
            tamanho ? (item.id === id && item.tamanho === tamanho) : item.id === id
        );
        
        if (index > -1) {
            this.carrinho.splice(index, 1);
            this.salvarCarrinho();
            this.atualizarInterface();
            this.mostrarNotificacao('Produto removido do carrinho');
        }
    }

    atualizarQuantidade(id, quantidade, tamanho = null) {
        const item = this.carrinho.find(item => 
            tamanho ? (item.id === id && item.tamanho === tamanho) : item.id === id
        );
        
        if (item) {
            if (quantidade <= 0) {
                this.removerProduto(id, tamanho);
            } else {
                item.quantidade = parseInt(quantidade);
                this.salvarCarrinho();
                this.atualizarInterface();
            }
        }
    }

    diminuirQuantidade(id, tamanho = null) {
        const item = this.carrinho.find(item => 
            tamanho ? (item.id === id && item.tamanho === tamanho) : item.id === id
        );
        
        if (item) {
            if (item.quantidade > 1) {
                item.quantidade--;
                this.salvarCarrinho();
                this.atualizarInterface();
            } else {
                this.removerProduto(id, tamanho);
            }
        }
    }

    limparCarrinho() {
        this.carrinho = [];
        this.salvarCarrinho();
        this.atualizarInterface();
        this.mostrarNotificacao('Carrinho limpo');
    }

    getTotalItens() {
        return this.carrinho.reduce((total, item) => total + item.quantidade, 0);
    }

    getValorTotal() {
        return this.carrinho.reduce((total, item) => total + (item.preco * item.quantidade), 0);
    }

    getCarrinho() {
        return this.carrinho;
    }

    atualizarInterface() {
        const cartCount = document.getElementById('cart-count');
        if (cartCount) {
            const total = this.getTotalItens();
            cartCount.textContent = total;
            cartCount.style.transform = 'scale(1.3)';
            setTimeout(() => { cartCount.style.transform = 'scale(1)'; }, 200);
        }

        if (window.location.pathname.includes('carrinho.html')) {
            this.renderizarCarrinho();
        }
    }

    renderizarCarrinho() {
        const cartItemsEl = document.getElementById('cart-items');
        const cartTotalEl = document.getElementById('cart-total');
        
        if (!cartItemsEl || !cartTotalEl) return;

        if (this.carrinho.length === 0) {
            cartItemsEl.innerHTML = '<li style="color: #999; text-align: center; padding: 20px;">Seu carrinho está vazio</li>';
            cartTotalEl.textContent = '0,00';
            return;
        }

        cartItemsEl.innerHTML = '';
        
        this.carrinho.forEach(item => {
            const subtotal = (item.preco * item.quantidade).toFixed(2).replace('.', ',');
            const precoFormatado = item.preco.toFixed(2).replace('.', ',');
            
            const itemHtml = `
                <li class="cart-item" style="border-bottom: 1px solid #333; padding: 15px 0; margin-bottom: 15px;">
                    <div style="display: flex; gap: 15px; align-items: center;">
                        <img src="${item.imagem}" alt="${item.nome}" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;">
                        <div style="flex: 1;">
                            <h4 style="color: #FFEA00; margin-bottom: 5px; font-size: 1rem;">${item.nome}</h4>
                            <p style="color: #999; margin: 5px 0; font-size: 0.9rem;">Tamanho: ${item.tamanho}</p>
                            <p style="color: #f0f0f0; margin: 5px 0;">R$ ${precoFormatado} x ${item.quantidade} = <strong style="color: #FFEA00;">R$ ${subtotal}</strong></p>
                            <div style="display: flex; gap: 10px; margin-top: 10px;">
                                <button onclick="carrinhoManager.diminuirQuantidade('${item.id}', '${item.tamanho}')" 
                                        style="background: #333; color: #fff; border: none; padding: 5px 12px; border-radius: 5px; cursor: pointer;">
                                    <i class="bi bi-dash"></i>
                                </button>
                                <span style="color: #f0f0f0; padding: 5px 10px;">${item.quantidade}</span>
                                <button onclick="carrinhoManager.atualizarQuantidade('${item.id}', ${item.quantidade + 1}, '${item.tamanho}')" 
                                        style="background: #FFEA00; color: #000; border: none; padding: 5px 12px; border-radius: 5px; cursor: pointer;">
                                    <i class="bi bi-plus"></i>
                                </button>
                                <button onclick="carrinhoManager.removerProduto('${item.id}', '${item.tamanho}')" 
                                        style="background: #ff4444; color: #fff; border: none; padding: 5px 12px; border-radius: 5px; cursor: pointer; margin-left: auto;">
                                    <i class="bi bi-trash"></i> Remover
                                </button>
                            </div>
                        </div>
                    </div>
                </li>
            `;
            
            cartItemsEl.insertAdjacentHTML('beforeend', itemHtml);
        });

        const total = this.getValorTotal().toFixed(2).replace('.', ',');
        cartTotalEl.textContent = total;
    }

    mostrarNotificacao(mensagem) {
        const notificacaoExistente = document.querySelector('.carrinho-notificacao');
        if (notificacaoExistente) notificacaoExistente.remove();

        const notificacao = document.createElement('div');
        notificacao.className = 'carrinho-notificacao';
        notificacao.innerHTML = `
            <i class="bi bi-check-circle"></i>
            <span>${mensagem}</span>
        `;
        notificacao.style.cssText = `
            position: fixed;
            top: 100px;
            right: 20px;
            background: linear-gradient(135deg, #FFEA00 0%, #FFC400 100%);
            color: #000;
            padding: 15px 25px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(255, 234, 0, 0.4);
            z-index: 10000;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
            animation: slideInRight 0.3s ease;
        `;

        document.body.appendChild(notificacao);

        setTimeout(() => {
            notificacao.style.animation = 'slideOutRight 0.3s ease';
            setTimeout(() => notificacao.remove(), 300);
        }, 3000);
    }

    inicializar() {
        this.atualizarInterface();

        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('add-to-cart') || e.target.closest('.add-to-cart')) {
                e.preventDefault();
                e.stopPropagation();
                
                const button = e.target.classList.contains('add-to-cart') ? e.target : e.target.closest('.add-to-cart');
                const produtoCard = button.closest('.produto-card');
                
                if (produtoCard) {
                    const id = button.dataset.id;
                    const nome = produtoCard.querySelector('.produto-card__titulo')?.textContent || produtoCard.querySelector('.produto-title')?.textContent || 'Produto';
                    const precoText = produtoCard.querySelector('.produto-card__preco')?.textContent || produtoCard.querySelector('.produto-price')?.textContent || 'R$ 0,00';
                    const preco = precoText ? precoText.replace('R$', '').replace('.', '').replace(',', '.').trim() : '0';
                    const imagem = produtoCard.querySelector('.produto-card__img')?.src || produtoCard.querySelector('img')?.src || 'img/default.png';
                    
                    this.adicionarProduto({ id, nome, preco, imagem });
                }
            }
        });
    }
}

// Instância global
const carrinhoManager = new CarrinhoManager();
window.carrinhoManager = carrinhoManager;

// Funções compatíveis com o antigo `js/carrinho.js`
function renderizarCarrinho() {
    if (typeof carrinhoManager.renderizarCarrinho === 'function') {
        carrinhoManager.renderizarCarrinho();
    }
}

function adicionarAoCarrinho(id, nome, preco, imagem = 'img/default.png', tamanho = 'M', quantidade = 1) {
    const precoNum = typeof preco === 'string' ? parseFloat(preco.toString().replace(',', '.')) || 0 : preco || 0;
    carrinhoManager.adicionarProduto({ id, nome, preco: precoNum, imagem, tamanho, quantidade });
}

function removerDoCarrinho(id, tamanho = null) {
    carrinhoManager.removerProduto(id, tamanho);
}

// Expor funções no window para compatibilidade
window.adicionarAoCarrinho = adicionarAoCarrinho;
window.removerDoCarrinho = removerDoCarrinho;
window.renderizarCarrinho = renderizarCarrinho;

// Adicionar animações CSS (mesmo estilo do arquivo anterior)
const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from { transform: translateX(400px); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }

    @keyframes slideOutRight {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(400px); opacity: 0; }
    }

    #cart-count { transition: transform 0.2s ease; }

    .carrinho-notificacao i { font-size: 1.2rem; }
`;
document.head.appendChild(style);