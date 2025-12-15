const puppeteer = require('puppeteer');
const path = require('path');

(async () => {
  const browser = await puppeteer.launch({ headless: true, args: ['--no-sandbox','--disable-setuid-sandbox'] });
  const page = await browser.newPage();

  const fileUrl = 'file://' + path.resolve(__dirname, '..', 'produto-detalhes.html') + '?id=1';
  console.log('Abrindo:', fileUrl);

  try {
    await page.goto(fileUrl, { waitUntil: 'networkidle2' });

    // aguardar botão de adicionar
    await page.waitForSelector('.btn-adicionar-carrinho', { timeout: 8000 });

    // garantir tamanho selecionado (clicar em M se necessário)
    const tamanhoM = await page.$('.tamanho-btn[data-tamanho="M"]');
    if (tamanhoM) await tamanhoM.click();

    // clicar em adicionar
    await page.click('.btn-adicionar-carrinho');

    // esperar pequena animação/atualização
    await new Promise(res => setTimeout(res, 800));

    // ler contador do carrinho
    const cartCount = await page.evaluate(() => {
      const el = document.getElementById('cart-count');
      return el ? el.textContent.trim() : null;
    });

    // ler localStorage
    const carrinhoLS = await page.evaluate(() => {
      return localStorage.getItem('carrinhoKoketsu');
    });

    console.log('cart-count:', cartCount);
    console.log('localStorage carrinhoKoketsu:', carrinhoLS);

    const parsed = carrinhoLS ? JSON.parse(carrinhoLS) : [];
    const itens = Array.isArray(parsed) ? parsed.reduce((s,i)=>s+i.quantidade,0) : null;

    // simples checagem
    if ((cartCount && parseInt(cartCount) >= 1) || (itens && itens >= 1)) {
      console.log('TESTE OK: produto adicionado ao carrinho');
      await browser.close();
      process.exit(0);
    } else {
      console.error('TESTE FALHOU: produto não foi adicionado');
      await browser.close();
      process.exit(2);
    }

  } catch (err) {
    console.error('Erro durante o teste:', err);
    await browser.close();
    process.exit(3);
  }
})();
