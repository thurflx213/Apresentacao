# 🎨 SUGESTÕES DE PERSONALIZAÇÃO VISUAL

## Efeitos CSS Avançados (Opcional)

### 1. Parallax Hero
Adicione ao `index-homepage.css`:

```css
.hero-bg {
  background-attachment: fixed;
  background-position: center;
}

@media (prefers-reduced-motion: no-preference) {
  .hero-content {
    animation: fadeInUp 1s ease-out;
  }
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
```

### 2. Glow Effect nos Botões
```css
.btn-explore {
  box-shadow: 0 0 20px rgba(255, 215, 0, 0.5);
  animation: glow 2s ease-in-out infinite;
}

@keyframes glow {
  0%, 100% {
    box-shadow: 0 0 20px rgba(255, 215, 0, 0.5);
  }
  50% {
    box-shadow: 0 0 30px rgba(255, 215, 0, 0.8);
  }
}
```

### 3. Hover Scale nos Cards
```css
.product-card {
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.product-card:hover {
  transform: translateY(-8px) scale(1.02);
}
```

### 4. Background Pattern Zebra
Adicione ao hero-bg (estilo da marca):

```css
.hero-bg::before {
  content: '';
  position: absolute;
  width: 100%;
  height: 100%;
  background-image: repeating-linear-gradient(
    45deg,
    transparent,
    transparent 35px,
    rgba(255, 215, 0, 0.03) 35px,
    rgba(255, 215, 0, 0.03) 70px
  );
  z-index: 0;
}
```

---

## Melhorias de Imagem

### Imagens Otimizadas
Use ferramentas como:
- **TinyPNG**: https://tinypng.com/
- **ImageOptim**: https://imageoptim.com/
- **Squoosh**: https://squoosh.app/

### Formatos Modernos
```html
<!-- WebP com fallback -->
<picture>
  <source srcset="image.webp" type="image/webp">
  <source srcset="image.jpg" type="image/jpeg">
  <img src="image.jpg" alt="...">
</picture>
```

---

## Animações de Scroll

### AOS (Animate on Scroll)
Adicione ao HTML:

```html
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
  AOS.init({
    duration: 800,
    once: true
  });
</script>
```

Depois use nos elementos:
```html
<section data-aos="fade-up">
  Conteúdo
</section>
```

### Scroll Reveal
```javascript
// Adicione ao carousel.js
window.addEventListener('scroll', () => {
  const reveals = document.querySelectorAll('[data-reveal]');
  reveals.forEach(element => {
    const windowHeight = window.innerHeight;
    const elementTop = element.getBoundingClientRect().top;
    
    if (elementTop < windowHeight - 50) {
      element.classList.add('revealed');
    }
  });
});
```

CSS correspondente:
```css
[data-reveal] {
  opacity: 0;
  transform: translateY(30px);
  transition: all 0.6s ease-out;
}

[data-reveal].revealed {
  opacity: 1;
  transform: translateY(0);
}
```

---

## Melhorias de Acessibilidade

### Adicione Focus Visible
```css
button:focus-visible,
a:focus-visible {
  outline: 3px solid var(--primary-gold);
  outline-offset: 2px;
}
```

### Modo Escuro (Opcional)
```css
@media (prefers-color-scheme: dark) {
  /* Já está implementado em dark por padrão */
}
```

### ARIA Labels
```html
<button aria-label="Próximo slide" class="carousel-next">
  <i class="bi bi-chevron-right"></i>
</button>
```

---

## Melhorias de Performance

### 1. Lazy Loading de Imagens
```html
<img src="..." alt="..." loading="lazy">
```

### 2. Webp com Fallback
```html
<source srcset="image.webp" type="image/webp">
<source srcset="image.jpg" type="image/jpeg">
```

### 3. Minificar CSS/JS em Produção
- CSS: use cssnano
- JS: use terser

### 4. Service Worker para Cache
```javascript
if ('serviceWorker' in navigator) {
  navigator.serviceWorker.register('/sw.js');
}
```

---

## Temas de Cores Alternativos

### Tema Escuro Plus (Ultra Contraste)
```css
--primary-gold: #FFE44D; /* Mais vibrante */
--primary-dark: #0A0A0A; /* Mais escuro */
```

### Tema Cinzento (Minimalista)
```css
--primary-gold: #C0C0C0; /* Prata */
--primary-dark: #1A1A1A;
```

---

## Adicionar Busca

### HTML
```html
<form class="search-form" id="searchForm">
  <input type="search" placeholder="Buscar produtos...">
  <button type="submit"><i class="bi bi-search"></i></button>
</form>
```

### CSS
```css
.search-form {
  position: relative;
  width: 300px;
}

.search-form input {
  width: 100%;
  padding: 10px;
  border: 1px solid var(--primary-gold);
  border-radius: 4px;
}
```

### JS
```javascript
document.getElementById('searchForm').addEventListener('submit', (e) => {
  e.preventDefault();
  const query = e.target.querySelector('input').value;
  window.location.href = `/catalogo.html?search=${query}`;
});
```

---

## Adicionar Filtros

```html
<aside class="filters-sidebar">
  <h3>Filtrar Por</h3>
  
  <div class="filter-group">
    <h4>Preço</h4>
    <input type="range" min="0" max="1000">
  </div>
  
  <div class="filter-group">
    <h4>Categoria</h4>
    <label>
      <input type="checkbox"> Camisetas
    </label>
  </div>
</aside>
```

---

## Animação Typewriter

Para títulos:

```javascript
function typeWriter(element, text, speed = 50) {
  let index = 0;
  element.innerHTML = '';
  
  function type() {
    if (index < text.length) {
      element.innerHTML += text.charAt(index);
      index++;
      setTimeout(type, speed);
    }
  }
  
  type();
}

// Uso:
typeWriter(
  document.querySelector('.hero-title'),
  'EXCLUSIVIDADE QUE SUPERA LIMITES'
);
```

---

## Contador de Visitantes

```html
<div class="visitor-count">
  <p>Visitantes: <span id="count">0</span></p>
</div>
```

```javascript
if (!localStorage.getItem('visited')) {
  let count = parseInt(localStorage.getItem('visitCount') || '0');
  count++;
  localStorage.setItem('visitCount', count);
  document.getElementById('count').textContent = count;
  localStorage.setItem('visited', 'true');
}
```

---

## Adicionar Live Chat

```html
<!-- Exemplo com Tawk.to -->
<script src="https://embed.tawk.to/ID/default"></script>
```

Ou WhatsApp flutuante:
```html
<a href="https://wa.me/5511999999999" class="whatsapp-btn" target="_blank">
  <i class="bi bi-whatsapp"></i>
</a>
```

```css
.whatsapp-btn {
  position: fixed;
  bottom: 20px;
  right: 20px;
  width: 60px;
  height: 60px;
  background: #25D366;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 30px;
  z-index: 999;
  animation: bounce 2s infinite;
}

@keyframes bounce {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-10px); }
}
```

---

## Contador de Adicionar ao Carrinho

```javascript
let cartCount = localStorage.getItem('cartCount') || 0;

document.querySelectorAll('.btn-buy').forEach(btn => {
  btn.addEventListener('click', () => {
    cartCount++;
    localStorage.setItem('cartCount', cartCount);
    document.querySelector('.cart-count').textContent = cartCount;
  });
});

// Carregar ao iniciar
document.addEventListener('DOMContentLoaded', () => {
  document.querySelector('.cart-count').textContent = cartCount;
});
```

---

## Implementar Breadcrumb

```html
<nav aria-label="breadcrumb" class="breadcrumb-nav">
  <ol class="breadcrumb">
    <li><a href="index.html">Home</a></li>
    <li><a href="catalogo.html">Produtos</a></li>
    <li>Camiseta Premium</li>
  </ol>
</nav>
```

```css
.breadcrumb-nav {
  padding: 10px 20px;
  background: var(--secondary-dark);
  border-bottom: 1px solid var(--border-gold);
}

.breadcrumb li {
  display: inline;
  margin-right: 10px;
}

.breadcrumb a {
  color: var(--primary-gold);
}
```

---

**Todas essas sugestões são 100% opcionais. A homepage já está completa e funcional!**

Escolha as que mais se alinham com o estilo da marca KOKETSU GRIFE.
