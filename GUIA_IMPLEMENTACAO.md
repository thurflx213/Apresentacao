# 🚀 HOMEPAGE KOKETSU GRIFE - GUIA DE IMPLEMENTAÇÃO

## 📋 Checklist de Arquivos Criados/Modificados

### ✅ Arquivos Criados:
- `frontend/styles/pages/index-homepage.css` - Styling completo da homepage
- `frontend/js/carousel.js` - Funcionalidade do carousel hero
- `RESUMO_HOMEPAGE.md` - Documentação das alterações

### ✅ Arquivos Modificados:
- `frontend/pages/index.html` - Estrutura HTML completa
- `frontend/js/navbar.js` - Menu mobile e scroll effects
- `frontend/js/products.js` - Renderização de produtos em grid

---

## 🎯 Estrutura da Página

```
┌─────────────────────────────────────────────────────┐
│                    NAVBAR                            │
│  Logo | Menu | Search | Cart                         │
└─────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────┐
│                  HERO CAROUSEL                       │
│  • 3 Slides com auto-play                           │
│  • Navegação via arrows e indicators                │
│  • Botões de ação "EXPLORAR COLEÇÃO"               │
└─────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────┐
│              NOSSAS CATEGORIAS                       │
│  • 4 Cards em Grid (Camisetas, Calças, Polos...)   │
│  • Border dourada, imagens, textos destacados       │
└─────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────┐
│           PRODUTOS EM DESTAQUE                       │
│  • Grid 4x2 (8 produtos)                            │
│  • Badges, favoritos, preços                        │
│  • Botão "COMPRAR" em amarelo                       │
└─────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────┐
│  KOKETSU GRIFE: EXCLUSIVIDADE E ATITUDE             │
│  • Conteúdo + Logo grande                           │
│  • Botão "CONHEÇA NOSSA HISTÓRIA"                   │
└─────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────┐
│              NEWSLETTER SIGNUP                       │
│  • Input email + Botão CADASTRAR                    │
│  • Background dourado                               │
└─────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────┐
│                     FOOTER                           │
│  • 4 Colunas de links + Redes Sociais               │
│  • Logo + Payment methods + Copyright               │
└─────────────────────────────────────────────────────┘
```

---

## 🎨 Paleta de Cores

| Elemento | Cor | Código |
|----------|-----|--------|
| Dourado (Primary) | Amarelo/Dourado | `#FFD700` |
| Fundo | Preto | `#000000` |
| Fundo Secundário | Cinza Escuro | `#2a2a2a` |
| Texto Principal | Branco/Cinza | `#eeeeee` |
| Texto Secundário | Cinza Médio | `#999999` |

---

## 📱 Responsividade

### Desktop (1024px+)
- ✅ Navbar horizontal completa
- ✅ Hero em full width
- ✅ Grid de categorias 4 colunas
- ✅ Grid de produtos 4 colunas

### Tablet (768px - 1024px)
- ✅ Navbar compacta
- ✅ Grid de categorias 2 colunas
- ✅ Grid de produtos 2 colunas

### Mobile (até 768px)
- ✅ Menu hamburger funcional
- ✅ Hero com texto centralizado
- ✅ Grid de categorias 1-2 colunas
- ✅ Grid de produtos 1-2 colunas
- ✅ Newsletter em coluna

---

## 🔧 Como Testar Localmente

### Opção 1: PHP Built-in Server
```bash
cd c:\Users\jever\OneDrive\Área de Trabalho\Apresentacao
php -S localhost:8000
# Abrir: http://localhost:8000/frontend/pages/index.html
```

### Opção 2: Python SimpleHTTPServer
```bash
cd c:\Users\jever\OneDrive\Área de Trabalho\Apresentacao
python -m http.server 8000
# Abrir: http://localhost:8000/frontend/pages/index.html
```

### Opção 3: VS Code Live Server
- Instale extensão "Live Server"
- Clique direito no index.html → "Open with Live Server"

---

## 📦 Imagens Necessárias

Você precisa ter estas imagens na pasta `frontend/img/`:

```
img/
├── logo.jpg (✅ Já existe)
├── hero-bg.jpg (NOVO - Background slide 1)
├── hero-bg-2.jpg (NOVO - Background slide 2)
├── hero-bg-3.jpg (NOVO - Background slide 3)
├── camiseta-categoria.jpg (NOVO)
├── calcas-categoria.jpg (NOVO)
├── polo-categoria.jpg (NOVO)
├── looks-categoria.jpg (NOVO)
└── koketsu-logo-grande.svg (NOVO)
```

**Dimensões recomendadas:**
- Hero backgrounds: 1920x1080px (ou proporção 16:9)
- Categorias: 400x400px (quadrado)
- Logo grande: 250x250px

---

## 🔗 Integração com API

A homepage integra automaticamente com a API `/api/vitrine.php`:

```javascript
// O arquivo js/products.js busca:
GET /api/vitrine.php

// Espera resposta como:
[
  {
    "categoria": "CAMISETAS",
    "tag": "Novidades",
    "itens": [
      {
        "id": 1,
        "nome": "Camiseta Premium",
        "preco": "129.90",
        "img": "img/camiseta-1.jpg",
        "novo": true
      },
      ...
    ]
  },
  ...
]
```

---

## 🎯 Funcionalidades JavaScript

### Carousel Hero
- Auto-play a cada 6 segundos
- Pausa ao passar o mouse
- Navegação via arrows
- Indicadores de slide clicáveis

### Menu Mobile
- Hamburger animado
- Menu desliza da esquerda
- Fecha ao clicar em link
- Responsive em tablets/mobile

### Newsletter
- Validação de email
- Feedback visual ao submit
- Integração com backend

### Produtos
- Favorito toggle
- Adicionar ao carrinho
- Links para detalhes

---

## 🚨 Notas Importantes

1. **Favicon**: Considere adicionar um favicon
   ```html
   <link rel="icon" href="../img/favicon.ico">
   ```

2. **Meta Tags**: SEO meta tags já estão presentes

3. **Performance**: Imagens devem estar otimizadas
   - Use WebP onde possível
   - Comprima PNG/JPG
   - Lazy loading implementado

4. **Cache**: Adicione versionamento em CSS/JS em produção
   ```html
   <link rel="stylesheet" href="index-homepage.css?v=1.0">
   ```

---

## 🐛 Troubleshooting

### Carousel não funciona
- Verifique se `carousel.js` está sendo carregado
- Abra console (F12) e procure por erros

### Menu mobile não abre
- Verifique `navbar.js`
- Certifique-se que classe `.hamburger` existe no HTML

### Produtos não aparecem
- Verifique se API `/api/vitrine.php` está respondendo
- Abra DevTools → Network e veja requisição
- Verifique logs do servidor

### Estilos não carregam
- Limpe cache do navegador (Ctrl+Shift+Del)
- Verifique se `index-homepage.css` está em `frontend/styles/pages/`

---

## 📞 Suporte

Para dúvidas sobre a implementação:
1. Verifique o console do navegador (F12)
2. Valide o HTML em https://validator.w3.org
3. Teste CSS em https://jigsaw.w3.org/css-validator/

---

**Versão:** 1.0  
**Data:** 4 de Fevereiro de 2026  
**Status:** ✅ PRONTO PARA PRODUÇÃO
