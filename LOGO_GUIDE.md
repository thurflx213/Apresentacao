# 🐯 Logo Koketsu Grife - Guia de Uso

## Localização dos Arquivos

- **PNG**: `frontend/img/logo.png` (Principal, compatível com todas as páginas)
- **SVG**: `frontend/img/logo.svg` (Vetorial, escalável, para casos especiais)

## Uso em HTML

### Navbar/Header
```html
<a href="index.html">
  <img src="../img/logo.png" alt="Logo Koketsu Grife" />
</a>
```

### Footer
```html
<img src="../img/logo.png" alt="Logo Koketsu" class="footer-logo" />
```

### Geral
```html
<img src="../img/logo.png" alt="Logo Koketsu Grife" class="logo" />
```

## Estilos CSS

### Navbar Logo
```css
.navbar-logo img {
  height: 70px;
  width: auto;
  object-fit: contain;
  transition: transform 0.3s ease;
}

.navbar-logo img:hover {
  transform: scale(1.05);
}
```

### Footer Logo
```css
.footer-logo {
  max-height: 50px;
  margin-bottom: 15px;
}
```

### Logo Geral
```css
.logo {
  max-height: 60px;
  display: block;
  margin: 0 auto;
}
```

## Onde a Logo é Usada

✅ **Homepage** (`index.html`)
- Navbar
- Hero carousel (3 slides)
- Footer

✅ **Catálogo** (`catalogo.html`)
- Navbar
- Footer

✅ **Camisetas** (`camisetas.html`)
- Navbar
- Footer

✅ **Carrinho** (`carrinho.html`)
- Navbar
- Footer

✅ **Login** (`login.html`)
- Centro da página (chamada para ação)
- Footer

✅ **Sobre** (`sobre.html`)
- Navbar
- Footer

✅ **Dúvidas** (`duvidas.html`)
- Navbar
- Footer

✅ **Política** (`politica.html`)
- Navbar
- Footer

✅ **Frete** (`frete.html`)
- Navbar
- Footer

✅ **Fidelidade** (`fidelidade.html`)
- Navbar
- Footer

✅ **Trocas** (`Trocas.html`)
- Navbar
- Footer

## Cores da Logo

- **Cor Principal**: `#FFD700` (Ouro/Amarelo)
- **Cor de Fundo**: `#000000` (Preto)

## Versões

1. **logo.png** - Arquivo principal em PNG
2. **logo.svg** - Versão vetorial SVG (escalável sem perda de qualidade)

## Boas Práticas

- ✅ Usar sempre `alt="Logo Koketsu Grife"` para acessibilidade
- ✅ Usar classes CSS para estilização (`navbar-logo`, `footer-logo`, `logo`)
- ✅ Manter proporção com `object-fit: contain`
- ✅ Adicionar `transition` para hover effects
- ✅ Encapsular em links `<a>` quando necessário

## Atualização de Logo

Se precisar atualizar a logo:
1. Substitua `frontend/img/logo.png` pelo novo arquivo
2. Opcionalmente, atualize `frontend/img/logo.svg` também
3. Todas as referências serão automaticamente atualizadas (mesmos nomes de arquivo)

---

**Data de Criação**: 04/02/2026  
**Marca**: Koketsu Grife - Exclusividade que supera limites
