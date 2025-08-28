  // Pegar dados do localStorage
  const dadosVendas = JSON.parse(localStorage.getItem("vendas")) || [];
  const totalVendas = parseFloat(localStorage.getItem("totalVendas")) || 0;

  // Atualizar card de faturamento
  document.querySelector(".card h3").textContent = "R$ " + totalVendas.toLocaleString("pt-BR", { minimumFractionDigits: 2 });

  // Organizar dados por mês (assumindo que "Data da venda" está em formato YYYY-MM-DD)
  let vendasPorMes = Array(12).fill(0);

  dadosVendas.forEach(venda => {
    if (venda["Status"] === "Finalizado" && venda["Data da venda"]) {
      let data = new Date(venda["Data da venda"]);
      let mes = data.getMonth(); // 0 = janeiro
      vendasPorMes[mes] += parseFloat(venda["Valor da Venda"]) || 0;
    }
  });

  // Renderizar gráfico dinâmico
  const ctx = document.getElementById('lucrosChart').getContext('2d');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
      datasets: [
        {
          label: 'Lucros',
          data: vendasPorMes,
          backgroundColor: '#2ecc71'
        }
      ]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          labels: { color: '#fff' }
        }
      },
      scales: {
        x: {
          ticks: { color: '#fff' }
        },
        y: {
          ticks: { color: '#fff' }
        }
      }
    }
  });
  window.onload = function() {
  const vendas = JSON.parse(localStorage.getItem("vendas") || "[]");

  // Calcular faturamento total (somente vendas finalizadas)
  let faturamento = 0;
  let vendasPorMes = Array(12).fill(0); // índice 0 = Janeiro

  vendas.forEach(venda => {
    let valor = parseFloat(venda["Valor da Venda"] || 0);
    if (venda["Status"] === "Finalizado") {
      faturamento += valor;

      // Distribuir por mês
      if (venda["Data da Venda"]) {
        let mes = new Date(venda["Data da Venda"]).getMonth(); // 0-11
        vendasPorMes[mes] += valor;
      }
    }
  });

  // Atualizar faturamento na tela
  document.getElementById("faturamentoTotal").innerText = "R$ " + faturamento.toFixed(2);

  // Criar gráfico
  const ctx = document.getElementById('lucrosChart').getContext('2d');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
      datasets: [
        {
          label: 'Lucros',
          data: vendasPorMes,
          backgroundColor: '#2ecc71'
        }
      ]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { labels: { color: '#fff' } }
      },
      scales: {
        x: { ticks: { color: '#fff' } },
        y: { ticks: { color: '#fff' } }
      }
    }
  });
};


