<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lucros</title>
  <link rel="stylesheet" href="lucros.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <div class="container">
    <!-- Menu lateral -->
    <aside class="sidebar">
      <ul>
        <li onclick="window.location.href='../informacoes/vendas.php'">Vendas</li>
        <li class="active" onclick="window.location.href='lucros.html'">Lucros</li>
        <li onclick="window.location.href='gastos.html'">Gastos</li>
        <li onclick="window.location.href='funcionarios.html'">Funcionários</li>
        <li onclick="window.location.href='entregas.html'">Entregas</li>
      </ul>
      <div class="add">
        <button>+</button>
      </div>
    </aside>

    <!-- Conteúdo -->
    <main class="content">
      <div class="header-content">
        <h2>Lucros</h2>
        <button class="date-btn">Escolher Data</button>
      </div>

      <div class="card">
        <p><b>Faturamento</b></p>
        <h3 id="faturamentoTotal">R$ 0,00</h3>
        <p style="color:#2ecc71;">↑ 0% Aumento de Faturamento</p>
        <small>Dados da empresa</small>
      </div>

      <div class="chart-container">
        <canvas id="lucrosChart"></canvas>
      </div>
    </main>
  </div>

  <script src="lucros.js"></script>
</body>
</html>
