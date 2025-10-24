const faqs = document.querySelectorAll(".faq-question");
  
faqs.forEach((btn) => {
  btn.addEventListener("click", () => {
    const parent = btn.parentElement;
    parent.classList.toggle("open");
  });
});

// FUNÇÃO ADICIONADA: Formata um número para o padrão monetário BRL (0,00)
const formatPriceBRL = (number) => {
    // Usamos toFixed para garantir 2 casas decimais e replace para trocar o ponto por vírgula no final
    return number.toFixed(2).replace('.', ','); 
}


const produtos = [
  {
    categoria: "CAMISETAS",
    itens: [
      { id: "camiseta1", nome: "CAMISETA OVERSIZED - ESSENCE", preco: "100,00", img: "img/Captura de tela 2025-08-04 093118.png", alt: "Camiseta preta Koketsu Grife" },
      // Nomes de produto ajustados para remover a marca 'NOCAP' e 'COMP'
      { id: "camiseta2", nome: "CAMISETA OVERSIZED - BRANCA SIMPLES", preco: "20,00", img: "img/NOCAP.png", alt: "Camiseta branca Koketsu Grife" },
      { id: "camiseta3", nome: "CAMISETA OVERSIZED - MARROM", preco: "100,00", img: "img/CAMISETA MARROM.png", alt: "Camiseta estampada Koketsu Grife" },
      { id: "camiseta4", nome: "CAMISETA OVERSIZED - OFF WHITE", preco: "100,00", img: "img/camiseta off white.png", alt: "Camiseta estampada Koketsu Grife" },
    ]
  },
  {
    categoria: "CALÇAS",
    itens: [
      { id: "calca1", nome: "CALÇA DE MOLETOM - FREEDOM PRETA", preco: "200,00", img: "img/carca.png", alt: "Calça preta Koketsu Grife" },
      { id: "calca2", nome: "CALÇA DE MOLETOM - FREEDOM BRANCA", preco: "200,00", img: "img/calça 2.png", alt: "Calça branca Koketsu Grife" },
      { id: "calca3", nome: "CALÇA DE MOLETOM - FREEDOM MARROM", preco: "200,00", img: "img/calça 3.png", alt: "Calça marrom Koketsu Grife" },
      { id: "calca4", nome: "CALÇA Y2K - BAGGY", preco: "200,00", img: "img/calça 4.png", alt: "Calça jeans cinza Koketsu Grife" },
     
    ]
  },
  {
    categoria: "BLUSAS",
    itens: [
      { id: "blusa1", nome: "ZIP UP - GOLA ALTA", preco: "180,00", img: "img/moletom.png", alt: "Moletom Gola Alta Koketsu Grife" },
      { id: "blusa1", nome: "MOLETOM GOLA CARECA - FACE", preco: "180,00", img: "img/moletom 2.png", alt: "Moletom preto Koketsu Grife" },
      { id: "blusa1", nome: "MOLETOM GOLA CARECA - LOGO", preco: "180,00", img: "img/moletom 3.png", alt: "Moletom off white Koketsu Grife" },
      { id: "blusa1", nome: "CASACO MOLETOM OVERSIZED - LOGO", preco: "180,00", img: "img/moletom 4.png", alt: "Moletom oversized Koketsu Grife" },
    ]
  },
  {
    categoria: "SAPATOS",
    itens: [
      { id: "sapato1", nome: "Tênis Nike Air Max Dn Feminino", preco: "250,00", img: "img/dn.png", alt: "Tênis Nike preto" },
      { id: "sapato1", nome: "Air Max DN Vermelho", preco: "250,00", img: "img/dn vermelho.png", alt: "Tênis Nike vermelho e preto" },
      { id: "sapato1", nome: "Tênis Nike Air Max Dn Masculino", preco: "250,00", img: "img/dn branco 3232.png", alt: "Tênis Nike branco e preto" },
      { id: "sapato1", nome: "Tênis Nike Air Max Plus Drift Feminino", preco: "250,00", img: "img/TN.png", alt: "Tênis Nike azul claro" },
    ]
  },
  {
    categoria: "CAMISAS - POLO",
    itens: [
      { id: "bone1", nome: "Camisa Polo Nike Court Dri-FIT Masculina", preco: "80,00", img: "img/polo .png", alt: "Polo preta" },
      { id: "bone1", nome: "Camisa Polo Nike Court Dri-FIT Masculina Azul", preco: "80,00", img: "img/polo 2.png", alt: "Polo azul" },
      { id: "bone1", nome: "Camisa Polo Nike Court Dri-FIT Masculina Vermelha", preco: "80,00", img: "img/polo 3.png", alt: "Polo vermelha" },
      { id: "bone1", nome: "Camisa Polo Nike Court Dri-FIT Masculina", preco: "80,00", img: "img/polo .png", alt: "Polo preta" },
    ]
  }
];

const container = document.getElementById("vitrine");

produtos.forEach(secao => {
  const section = document.createElement("section");
  section.classList.add("mb-5");

  const titulo = document.createElement("h2");
  titulo.className = "text-center mb-5";
  titulo.innerHTML = `${secao.categoria} <hr class="linha-interativa">`;
  section.appendChild(titulo);

  const row = document.createElement("div");
  row.className = "row g-4";

  secao.itens.forEach(prod => {
    // 1. Converter preço para número (troca "," por ".")
    const precoNumerico = parseFloat(prod.preco.replace(',', '.'));
    // 2. Calcular parcela (6x sem juros)
    const parcela = precoNumerico / 6;
    // 3. Formatar parcela para exibição
    const parcelaFormatada = formatPriceBRL(parcela);

    const col = document.createElement("div");
    col.className = "col-12 col-sm-6 col-md-4 col-lg-3";
    col.innerHTML = `
      <a href="produto.html?id=${prod.id}" class="text-decoration-none text-dark">
        <div class="card h-100">
          <img src="${prod.img}" class="card-img-top" alt="${prod.alt}">
          <div class="card-body text-center">
            <h4 class="card-title text-uppercase">${prod.nome}</h4>
            <p class="card-text">R$ ${prod.preco}</p>
            <h5>ou 6x de R$${parcelaFormatada} no cartão s/juros</h5>
            
          </div>
        </div>
      </a>
    `;
    row.appendChild(col);
  });

  section.appendChild(row);
  container.appendChild(section);
});
window.addEventListener("scroll", function () {
  const navbar = document.getElementById("navbar");
  if (window.scrollY > 50) {
    navbar.classList.add("scrolled");
  } else {
    navbar.classList.remove("scrolled");
  }
}
);