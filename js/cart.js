/**
 * Gerenciador de Carrinho
 * Responsável por adicionar, remover e gerenciar itens no carrinho
 */

const CartManager = (() => {
  const CART_STORAGE_KEY = 'koketsu_cart';

  /**
   * Obtém o carrinho atual do localStorage
   */
  const getCart = () => {
    try {
      const cart = localStorage.getItem(CART_STORAGE_KEY);
      return cart ? JSON.parse(cart) : [];
    } catch (error) {
      console.error('Erro ao obter carrinho:', error);
      return [];
    }
  };

  /**
   * Salva o carrinho no localStorage
   */
  const saveCart = (cart) => {
    try {
      localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(cart));
      // Disparar evento para atualizar outras partes da página
      window.dispatchEvent(new Event('cartUpdated'));
    } catch (error) {
      console.error('Erro ao salvar carrinho:', error);
    }
  };

  /**
   * Adiciona um produto ao carrinho
   */
  const addToCart = (product, quantity = 1) => {
    const cart = getCart();
    
    // Verificar se o produto já existe no carrinho
    const existingItem = cart.find(item => item.id === product.id);
    
    if (existingItem) {
      existingItem.quantidade += quantity;
    } else {
      cart.push({
        id: product.id,
        nome: product.nome,
        preco: product.preco,
        img: product.img,
        quantidade: quantity,
        parcelas: product.parcelas
      });
    }
    
    saveCart(cart);
    console.log(`${product.nome} adicionado ao carrinho`);
    return cart;
  };

  /**
   * Remove um produto do carrinho
   */
  const removeFromCart = (productId) => {
    const cart = getCart();
    const filteredCart = cart.filter(item => item.id !== productId);
    saveCart(filteredCart);
    console.log(`Produto ${productId} removido do carrinho`);
    return filteredCart;
  };

  /**
   * Atualiza a quantidade de um produto
   */
  const updateQuantity = (productId, quantity) => {
    const cart = getCart();
    const item = cart.find(item => item.id === productId);
    
    if (item) {
      if (quantity <= 0) {
        return removeFromCart(productId);
      }
      item.quantidade = quantity;
      saveCart(cart);
    }
    
    return cart;
  };

  /**
   * Limpa o carrinho completamente
   */
  const clearCart = () => {
    localStorage.removeItem(CART_STORAGE_KEY);
    window.dispatchEvent(new Event('cartUpdated'));
    console.log('Carrinho limpo');
    return [];
  };

  /**
   * Calcula o total do carrinho
   */
  const getTotal = () => {
    const cart = getCart();
    return cart.reduce((total, item) => total + (item.preco * item.quantidade), 0);
  };

  /**
   * Retorna a quantidade de itens no carrinho
   */
  const getItemCount = () => {
    const cart = getCart();
    return cart.reduce((count, item) => count + item.quantidade, 0);
  };

  /**
   * Inicializa os listeners de clique nos botões "Adicionar ao Carrinho"
   */
  const initAddToCartButtons = () => {
    document.addEventListener('click', (e) => {
      const button = e.target.closest('.btn-quick-buy');
      if (button) {
        const productId = button.dataset.productId;
        
        // Buscar o produto nos dados renderizados
        const productCard = button.closest('.product-card');
        if (productCard) {
          const titleElement = productCard.querySelector('.card-title');
          const priceElement = productCard.querySelector('.main-price');
          const imgElement = productCard.querySelector('.card-main-img');
          const installmentsElement = productCard.querySelector('.installments-value');
          
          if (titleElement && priceElement && imgElement) {
            // Extrair preço do formato "R$ XX,XX"
            const priceText = priceElement.textContent.replace('R$', '').trim();
            const price = parseFloat(priceText.replace(',', '.'));
            
            // Extrair parcelas
            const installmentsText = installmentsElement?.textContent || '';
            const parcelas = parseFloat(installmentsText.replace('de R$', '').replace('sem juros', '').trim()) || price / 6;
            
            const product = {
              id: productId,
              nome: titleElement.textContent.trim(),
              preco: price,
              img: imgElement.src,
              parcelas: parcelas
            };
            
            addToCart(product);
            
            // Feedback visual
            const originalText = button.textContent;
            button.textContent = '✓ Adicionado!';
            button.disabled = true;
            
            setTimeout(() => {
              button.textContent = originalText;
              button.disabled = false;
            }, 1500);
          }
        }
      }
    });
  };

  /**
   * Atualiza o contador de itens na navbar
   */
  const updateCartBadge = () => {
    const count = getItemCount();
    const badge = document.querySelector('.cart-badge');
    
    if (badge) {
      if (count > 0) {
        badge.textContent = count;
        badge.style.display = 'block';
      } else {
        badge.style.display = 'none';
      }
    }
  };

  // Inicializar quando o DOM estiver pronto
  document.addEventListener('DOMContentLoaded', () => {
    initAddToCartButtons();
    updateCartBadge();
    
    // Atualizar badge quando o carrinho mudar
    window.addEventListener('cartUpdated', updateCartBadge);
  });

  return {
    getCart,
    addToCart,
    removeFromCart,
    updateQuantity,
    clearCart,
    getTotal,
    getItemCount,
    initAddToCartButtons
  };
})();
