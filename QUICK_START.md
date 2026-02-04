# 🚀 QUICK START - HOMEPAGE KOKETSU GRIFE

## 1️⃣ Acessar a Página

### Opção A: Usando PHP (Recomendado)
```bash
# Terminal/PowerShell
cd "c:\Users\jever\OneDrive\Área de Trabalho\Apresentacao"
php -S localhost:8000

# Depois abra no navegador:
http://localhost:8000/frontend/pages/index.html
```

### Opção B: Usando VS Code Live Server
```
1. Instale extensão "Live Server" (5M+ downloads)
2. Clique direito no index.html
3. Selecione "Open with Live Server"
```

### Opção C: Usando Python
```bash
cd "c:\Users\jever\OneDrive\Área de Trabalho\Apresentacao"
python -m http.server 8000

# Depois: http://localhost:8000/frontend/pages/index.html
```

---

## 2️⃣ Estrutura de Pastas

```
Apresentacao/
├── frontend/
│   ├── pages/
│   │   └── index.html ✅ HOMEPAGE NOVA
│   ├── styles/
│   │   └── pages/
│   │       └── index-homepage.css ✅ NOVO CSS
│   ├── js/
│   │   ├── carousel.js ✅ NOVO CAROUSEL
│   │   ├── navbar.js ✅ ATUALIZADO
│   │   └── products.js ✅ ATUALIZADO
│   └── img/
│       └── logo.jpg (✅ já existe)
│
├── RESUMO_HOMEPAGE.md
├── GUIA_IMPLEMENTACAO.md
├── SUGESTOES_PERSONALIZACAO.md
├── EXEMPLO_DADOS_API.json
└── CHECKLIST_FINAL.md
```

---

## 3️⃣ Imagens Necessárias

Crie ou adicione estas imagens em `frontend/img/`:

| Arquivo | Dimensão | Descrição |
|---------|----------|-----------|
| hero-bg.jpg | 1920x1080 | Background slide 1 |
| hero-bg-2.jpg | 1920x1080 | Background slide 2 |
| hero-bg-3.jpg | 1920x1080 | Background slide 3 |
| camiseta-categoria.jpg | 400x400 | Categoria camisetas |
| calcas-categoria.jpg | 400x400 | Categoria calças |
| polo-categoria.jpg | 400x400 | Categoria polos |
| looks-categoria.jpg | 400x400 | Categoria looks |

**Placeholder:** Use https://via.placeholder.com/1920x1080?text=Hero+Slide

---

## 4️⃣ Testar Funcionalidades

### ✅ Navbar
- [ ] Logo clicável (volta a home)
- [ ] Menu links funcionam
- [ ] Ícones de busca e carrinho visíveis
- [ ] Em mobile: hamburger abre/fecha menu

### ✅ Carousel
- [ ] Auto-play (muda a cada 6 seg)
- [ ] Arrows navegam slides
- [ ] Dots indicam slide atual
- [ ] Pause ao passar mouse

### ✅ Categorias
- [ ] 4 cards com imagens
- [ ] Border dourada
- [ ] Links funcionam

### ✅ Produtos
- [ ] Grid mostra 8 produtos
- [ ] Badges aparecem (NOVO, EXCLUSIVO)
- [ ] Coração favorito funciona
- [ ] Botão COMPRAR responsivo

### ✅ Newsletter
- [ ] Input email validado
- [ ] Botão CADASTRAR funciona
- [ ] Background dourado aparece

### ✅ Footer
- [ ] 4 colunas de links
- [ ] Redes sociais com ícones
- [ ] Copyright visível

---

## 5️⃣ Dados de Teste (Para Produtos)

Se quiser testar com dados fictícios, adicione ao `carousel.js`:

```javascript
// Substitua a função fetchProducts (linha ~30):
const fetchProducts = async () => {
  return [
    {
      "categoria": "CAMISETAS",
      "tag": "Premium",
      "itens": [
        {"id":1, "nome":"Camiseta Premium","preco":"129.90","img":"../img/logo.jpg","novo":true},
        {"id":2, "nome":"Camiseta Deluxe","preco":"149.90","img":"../img/logo.jpg","novo":false},
        // ... mais 6 produtos
      ]
    }
  ];
};
```

---

## 6️⃣ Customize Cores (Opcional)

Abra `frontend/styles/pages/index-homepage.css` e mude as cores:

```css
:root {
  --primary-gold: #FFD700;    /* Mude a cor principal */
  --primary-dark: #1a1a1a;    /* Fundo escuro */
  --secondary-dark: #2a2a2a;  /* Fundo secundário */
  --light-text: #eeeeee;      /* Texto claro */
  --text-gray: #999999;       /* Texto médio */
}
```

---

## 7️⃣ Desvios Comuns (Troubleshooting)

### "Página em branco"
```
1. Abra DevTools (F12)
2. Vá para Console
3. Procure por erros vermelhos
4. Verifique caminhos das imagens
```

### "Carousel não funciona"
```
1. Verifique se carousel.js está carregando
2. Verifique se HTML tem os elementos corretos
3. Procure por erros no Console
```

### "Imagens não carregam"
```
1. Verifique caminhos: ../img/nome.jpg
2. Certifique-se que arquivo existe
3. Use DevTools > Network para ver requisição
```

### "Menu mobile não abre"
```
1. Verifique navbar.js
2. Veja se hamburger.active toggle funciona
3. Procure erros no Console
```

---

## 8️⃣ Performance Check

Abra DevTools (F12) e veja:

- **Performance Tab:** Verifique loading time
- **Network Tab:** Comprove que recursos carregam
- **Console Tab:** Não deve ter erros vermelhos
- **Elements Tab:** Inspeção de HTML/CSS

**Meta:** Carregamento < 3 segundos

---

## 9️⃣ Deploy Rápido (Vercel)

```bash
# 1. Instale Vercel CLI
npm install -g vercel

# 2. Vá para o projeto
cd "c:\Users\jever\OneDrive\Área de Trabalho\Apresentacao"

# 3. Deploy
vercel

# 4. Segue as instruções
```

---

## 🔟 Customizações Rápidas

### Mudar Texto do Hero
Abra `frontend/pages/index.html` linha ~76:
```html
<h1 class="hero-title">SEU TEXTO AQUI</h1>
```

### Mudar Links de Redes Sociais
Abra `frontend/pages/index.html` footer:
```html
<a href="https://seu-instagram.com">
```

### Mudar Cores dos Botões
Abra `index-homepage.css`:
```css
.btn-explore {
  background: #SUA-COR;
}
```

---

## 📱 Teste em Mobile

### Via Android/iOS Físico
```
1. Esteja na mesma WiFi
2. No servidor: use IP local (ex: 192.168.1.100:8000)
3. No celular: acesse http://SEU-IP:8000
```

### Via DevTools Emulação
```
1. Abra DevTools (F12)
2. Clique Ctrl+Shift+M (Toggle device toolbar)
3. Selecione device (iPhone, Android, etc)
4. Teste responsividade
```

---

## 🎯 Próximas Ações

**Hoje:**
- [ ] Acessar homepage
- [ ] Verificar layout
- [ ] Testar carousel
- [ ] Testar menu mobile

**Amanhã:**
- [ ] Adicionar imagens
- [ ] Configurar produtos API
- [ ] Testar em navegadores
- [ ] Testar em mobile

**Esta semana:**
- [ ] Implementar newsletter
- [ ] Configurar carrinho
- [ ] Setup analytics
- [ ] Deploy em servidor

---

## 💡 Dicas Finais

✨ **Otimizar Imagens:**
Use https://squoosh.app/ para comprimir imagens

✨ **Testar Lighthouse:**
DevTools > Lighthouse > Generate report

✨ **Remover Cache:**
Ctrl+Shift+Del > Cache > Limpar

✨ **Versionar CSS/JS:**
Adicione ?v=1.0 ao final dos links em produção

✨ **Monitorar Erros:**
Use Sentry (https://sentry.io) para produção

---

## 📞 Checklist Rápido (Antes de Publicar)

- [ ] Todas as imagens carregam
- [ ] Navbar responsivo (desktop + mobile)
- [ ] Carousel funciona
- [ ] Produtos aparecem (se API ativa)
- [ ] Newsletter valida email
- [ ] Links funcionam
- [ ] Footer completo
- [ ] Sem erros no console
- [ ] Testar em 2+ navegadores
- [ ] Testar em mobile
- [ ] Performance > 90 (Lighthouse)
- [ ] Imagens otimizadas

---

## 🎉 Parabéns!

Sua homepage KOKETSU GRIFE está pronta para o mundo! 🚀

**Arquivos principais:**
- `frontend/pages/index.html` (Homepage)
- `frontend/styles/pages/index-homepage.css` (Estilos)
- `frontend/js/carousel.js` (Carousel)
- `frontend/js/navbar.js` (Navegação)
- `frontend/js/products.js` (Produtos)

---

**Data:** 4 de Fevereiro de 2026  
**Status:** ✅ PRONTO PARA PUBLICAÇÃO
