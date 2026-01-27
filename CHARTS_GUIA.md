# 📊 Chart.js - Instalado no Projeto Koketsu

## ✅ Instalação Concluída

Chart.js foi instalado com sucesso via npm. Você pode usar gráficos em seu projeto agora!

---

## 📦 O que foi instalado

```json
{
  "chart.js": "^4.4.1",
  "bootstrap": "^5.3.0",
  "bootstrap-icons": "^1.11.1"
}
```

**Localização**: `/node_modules/chart.js/`

---

## 🚀 Como Usar

### 1. **Incluir Chart.js no seu HTML/PHP**

```html
<!-- CDN Online (alternativa) -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- OU usar o arquivo local instalado -->
<script src="/node_modules/chart.js/dist/chart.umd.min.js"></script>
```

### 2. **Criar um Gráfico**

```html
<!-- Canvas para o gráfico -->
<canvas id="meuGrafico"></canvas>

<script>
const ctx = document.getElementById('meuGrafico').getContext('2d');
const meuGrafico = new Chart(ctx, {
    type: 'line', // 'line', 'bar', 'pie', 'doughnut', 'scatter', etc
    data: {
        labels: ['Janeiro', 'Fevereiro', 'Março'],
        datasets: [{
            label: 'Vendas',
            data: [12, 19, 3],
            borderColor: '#dfd155',
            backgroundColor: 'rgba(223, 209, 85, 0.1)'
        }]
    },
    options: {
        responsive: true
    }
});
</script>
```

---

## 📌 Exemplo Pronto

Existe um arquivo de exemplo em:
```
backend/Views/Templates/partials/charts-example.php
```

**Para usar o exemplo:**

1. Abra o arquivo `charts-example.php`
2. Copie o conteúdo
3. Cole em sua página (ex: dashboard, relatórios)
4. Adapte os dados conforme necessário

---

## 📊 Tipos de Gráficos Disponíveis

| Tipo | Uso |
|------|-----|
| **line** | Gráficos de linha (vendas ao longo do tempo) |
| **bar** | Gráficos de barras (comparações) |
| **pie** | Gráficos de pizza (proporções) |
| **doughnut** | Gráficos de rosca (proporções com centro vazio) |
| **scatter** | Gráficos de dispersão |
| **bubble** | Gráficos de bolha |
| **radar** | Gráficos de radar |
| **polarArea** | Gráfico de área polar |

---

## 🎨 Exemplo: Gráfico de Vendas

```javascript
const ctx = document.getElementById('vendas').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Produto A', 'Produto B', 'Produto C', 'Produto D'],
        datasets: [{
            label: 'Vendas (unidades)',
            data: [120, 190, 150, 170],
            backgroundColor: '#dfd155',
            borderColor: '#c4a33a',
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: { beginAtZero: true }
        }
    }
});
```

---

## 🔗 Integração com Dados do Banco

Para integrar com dados reais do banco, passe os dados via PHP:

**No Controller (PHP):**
```php
$vendas = [100, 150, 200, 175]; // Do banco
$meses = ['Jan', 'Fev', 'Mar', 'Abr'];

$this->view->render('dashboard', [
    'vendas' => $vendas,
    'meses' => $meses
]);
```

**Na View (PHP/JavaScript):**
```html
<canvas id="vendas"></canvas>
<script>
new Chart(document.getElementById('vendas').getContext('2d'), {
    type: 'line',
    data: {
        labels: <?php echo json_encode($meses); ?>,
        datasets: [{
            label: 'Vendas',
            data: <?php echo json_encode($vendas); ?>,
            borderColor: '#dfd155'
        }]
    }
});
</script>
```

---

## 📚 Documentação Oficial

- Chart.js Docs: https://www.chartjs.org/docs/latest/
- Exemplos: https://www.chartjs.org/samples/latest/

---

## ✨ Sugestões de Uso no Projeto

1. **Dashboard Admin**: Gráficos de vendas mensais
2. **Relatórios**: Comparações de categorias, tamanhos, cores
3. **Análise de Usuários**: Gráficos de crescimento
4. **Estoque**: Movimentação e níveis de estoque
5. **Avaliações**: Distribuição de ratings

---

**Pronto para criar gráficos incríveis no seu projeto! 🎉**
