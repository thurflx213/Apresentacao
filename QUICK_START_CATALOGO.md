# ⚡ QUICK START - CATÁLOGO E PRODUTOS

## 🚀 Como Usar

### 1. Acessar o Catálogo
```
URL: /pages/catalogo.html
```

### 2. Filtrar Produtos
- Marque categorias na sidebar esquerda
- Arraste o slider de preço
- Os produtos serão filtrados em tempo real

### 3. Ordenar
Use o dropdown "Ordenar por":
- Mais Recentes (padrão)
- Menor Preço
- Maior Preço
- Mais Vendidos

### 4. Navegar
- Clique nos números para ir a página específica
- Use setas para próxima/anterior

### 5. Ver Produto
- Clique em "COMPRAR AGORA" ou na imagem
- Será levado para `/pages/produto.html?id=X`

### 6. Selecionar Atributos
- **Tamanho**: P, M, G, GG
- **Cor**: Preto, Branco, Azul
- **Quantidade**: 1 a 10 unidades

### 7. Adicionar ao Carrinho
- Clique em "Adicionar ao Carrinho"
- Veja o contador atualizar na navbar

### 8. Favoritar
- Clique no ❤️ para salvar nos favoritos
- Dados persistem entre sessões

---

## 🎯 URLs Importantes

| Página | URL |
|--------|-----|
| Catálogo | `/pages/catalogo.html` |
| Produto | `/pages/produto.html?id=NUMERO` |
| Carrinho | `/pages/carrinho.html` |
| Inicial | `/pages/index.html` |

---

## 💾 Dados no LocalStorage

```javascript
// Ver carrinho
JSON.parse(localStorage.getItem('cart'))

// Ver favoritos
JSON.parse(localStorage.getItem('favorites'))

// Limpar carrinho
localStorage.removeItem('cart')

// Limpar favoritos
localStorage.removeItem('favorites')
```

---

## 🐛 Se Algo Não Funcionar

### Problema: Produtos não carregam
**Solução:**
- Verifique se `/api/vitrine.php` está acessível
- Abra o Console (F12) e procure por erros
- Verifique conexão de internet

### Problema: Imagens não aparecem
**Solução:**
- Imagens devem estar em `/img/`
- Use nomes sem espaços
- Formatos suportados: JPG, PNG, WebP

### Problema: Filtros não funcionam
**Solução:**
- Recarregue a página (Ctrl+F5)
- Limpe cache do navegador
- Abra Console para erros

### Problema: Carrinho vazio após recarregar
**Solução:**
- LocalStorage precisa estar habilitado
- Não use modo privado/incógnito
- Verifique configurações de cookies

---

## 🔧 Customizar

### Alterar Tamanhos Disponíveis
Edite em `frontend/js/produto.js`:
```javascript
const sizes = ['P', 'M', 'G', 'GG'];
```

### Alterar Cores
Edite em `frontend/js/produto.js`:
```javascript
const colors = [
  { name: 'Preto', hex: '#000000' },
  { name: 'Branco', hex: '#FFFFFF' },
  { name: 'Azul', hex: '#1E3A8A' }
];
```

### Alterar Número de Produtos por Página
Edite em `frontend/js/catalogo.js`:
```javascript
const productsPerPage = 12; // Mude para outro número
```

### Alterar Cores do Tema
Edite em `frontend/styles/pages/catalogo.css` ou `produto.css`:
```css
:root {
    --gold: #FFD700; /* Mude aqui */
    --dark-bg: #000000;
    /* ... */
}
```

---

## 📊 Estrutura de Dados Esperada

### Formato da API (/api/vitrine.php):
```javascript
[
  {
    categoria: "Camisetas",
    tag: "",
    itens: [
      {
        id: 1,
        nome: "Camiseta Premium",
        preco: 99.90,
        img: "img/camiseta.png",
        alt: "Descrição..."
      },
      // ... mais itens
    ]
  },
  // ... mais categorias
]
```

---

## ✅ Verificação Final

Antes de publicar, verifique:

- [ ] Catálogo carrega produtos
- [ ] Filtros funcionam
- [ ] Paginação está OK
- [ ] Produto abre com ID correto
- [ ] Imagens aparecem
- [ ] Botões não têm erro no console
- [ ] Responsivo em mobile
- [ ] Carrinho persiste dados
- [ ] Favoritos funcionam
- [ ] Links não levam a 404

---

## 📞 Suporte

Em caso de dúvidas:
1. Verifique a `CATALOGO_PRODUTOS_GUIA.md`
2. Abra o Console do navegador (F12)
3. Procure por mensagens de erro
4. Consulte comentários no código

---

**Versão**: 1.0  
**Data**: 04/02/2026  
**Pronto para usar! 🎉**
