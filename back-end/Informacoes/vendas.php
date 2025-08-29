<?php
require_once '../database/database.php';
require_once '../dao/VendasDAO.php';
session_start();

// Se for salvar (POST via fetch)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(400);
        echo json_encode(['mensagem' => 'JSON inválido.']);
        exit;
    }

    if (!isset($_SESSION['id_empresa'])) {
        http_response_code(401);
        echo json_encode(['mensagem' => 'Sessão expirada, faça login novamente.']);
        exit;
    }

    $id_empresa = $_SESSION['id_empresa'];
    $vendasDAO = new VendasDAO();
    $sucesso = $vendasDAO->salvarVendas($id_empresa, $data); // salva apenas novos dados

    if ($sucesso) {
        echo json_encode(['mensagem' => 'Vendas salvas com sucesso!']);
    } else {
        http_response_code(500);
        echo json_encode(['mensagem' => 'Erro ao salvar vendas.']);
    }
    exit;
}

// Se for GET, buscar vendas no banco
$id_empresa = $_SESSION['id_empresa'] ?? null;
$vendas = [];
if ($id_empresa) {
    $vendasDAO = new VendasDAO();
    $registros = $vendasDAO->obterVendasPorEmpresa($id_empresa);

    foreach ($registros as $reg) {
        $dados = $reg['dados_venda'];
        if (is_string($dados)) {
            $dados = json_decode($dados, true);
        }
        if ($dados) {
            if (isset($dados[0]) && is_array($dados[0])) {
                foreach ($dados as $linha) {
                    $vendas[] = $linha;
                }
            } else {
                $vendas[] = $dados;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tabela de Vendas</title>
<link rel="stylesheet" href="vendas.css">
</head>
<body>
<div class="container">
  <aside class="sidebar">
    <ul>
      <li class="active" onclick="window.location.href='vendas.php'">Vendas</li>
      <li onclick="window.location.href='../lucros/lucros.html'">Lucros</li>
      <li onclick="window.location.href='gastos.html'">Gastos</li>
      <li onclick="window.location.href='funcionarios.html'">Funcionários</li>
      <li onclick="window.location.href='entregas.html'">Entregas</li>
    </ul>
    <div class="add"><button>+</button></div>
  </aside>

  <main class="content">
    <h2>Vendas</h2>
    <form id="formVendas">
      <table id="tabelaVendas">
        <thead>
          <tr id="headerRow">
            <th>Cliente</th>
            <th>Valor da Venda</th>
            <th>Data</th>
            <th id="statusHeader">Status</th>
          </tr>
        </thead>
        <tbody>
          <!-- Linhas carregadas pelo JS -->
        </tbody>
      </table>
      <br>
      <button type="button" onclick="adicionarLinha()">+ Nova Linha</button>
      <button type="button" onclick="abrirModal()">+ Nova Coluna</button>
      <button type="button" onclick="salvarTabela()">💾 Salvar Tudo</button>
    </form>
  </main>
</div>

<div class="modal" id="modalColuna">
  <div class="modal-content">
    <h3>Nome da nova coluna</h3>
    <input type="text" id="nomeColunaInput" placeholder="Digite o nome">
    <br>
    <button class="btn-confirm" onclick="confirmarColuna()">Adicionar</button>
    <button class="btn-cancel" onclick="fecharModal()">Cancelar</button>
  </div>
</div>

<script>
let colunaIndex = null;
// Dados vindos do PHP
const vendasBD = <?php echo json_encode($vendas); ?>;
let dadosExistentes = vendasBD.map(linha => JSON.stringify(linha));

// Carregar dados salvos ao iniciar
window.onload = function() {
  carregarTabela();
}

function abrirModal() {
  document.getElementById("modalColuna").style.display = "flex";
  document.getElementById("nomeColunaInput").value = "";
  colunaIndex = document.getElementById("statusHeader").cellIndex + 1;
}

function fecharModal() {
  document.getElementById("modalColuna").style.display = "none";
}

function confirmarColuna() {
  let nomeColuna = document.getElementById("nomeColunaInput").value.trim();
  if (!nomeColuna) { alert("Digite um nome para a coluna!"); return; }

  let tabela = document.getElementById("tabelaVendas");
  let headerRow = document.getElementById("headerRow");

  let novoTh = document.createElement("th");
  novoTh.textContent = nomeColuna;
  headerRow.insertBefore(novoTh, headerRow.cells[colunaIndex]);

  for (let i = 1; i < tabela.rows.length; i++) {
    let novaCelula = tabela.rows[i].insertCell(colunaIndex);
    novaCelula.innerHTML = `<input type="text">`;
  }
  fecharModal();
}

function adicionarLinha(linhaDados = {}) {
  let tabela = document.getElementById("tabelaVendas");
  let colunas = document.getElementById("headerRow").cells.length;
  let novaLinha = tabela.insertRow();

  for (let i = 0; i < colunas; i++) {
    let novaCelula = novaLinha.insertCell(i);
    let header = document.getElementById("headerRow").cells[i].innerText;

    if (i === document.getElementById("statusHeader").cellIndex) {
      novaCelula.innerHTML = `
        <select name="status">
          <option value="Negociando">Negociando</option>
          <option value="Finalizado">Finalizado</option>
        </select>`;
      if (linhaDados[header]) {
        novaCelula.querySelector("select").value = linhaDados[header];
        atualizarStatus(novaCelula.querySelector("select"));
      }
      novaCelula.querySelector("select").addEventListener("change", function() {
        atualizarStatus(this);
      });
    } else {
      novaCelula.innerHTML = `<input type="text" value="${linhaDados[header] || ''}">`;
    }
  }
}

function salvarTabela() {
  let tabela = document.getElementById("tabelaVendas");
  let headers = [];
  let novosDados = [];

  for (let th of tabela.rows[0].cells) { headers.push(th.innerText); }

  for (let i = 1; i < tabela.rows.length; i++) {
    let row = tabela.rows[i];
    let linhaDados = {};
    for (let j = 0; j < row.cells.length; j++) {
      let celula = row.cells[j];
      let input = celula.querySelector("input, select");
      linhaDados[headers[j]] = input ? input.value : "";
    }

    // Salva apenas linhas novas
    if (!dadosExistentes.includes(JSON.stringify(linhaDados))) {
      novosDados.push(linhaDados);
      dadosExistentes.push(JSON.stringify(linhaDados));
    }
  }

  if (novosDados.length === 0) {
    alert("Nenhum dado novo para salvar.");
    return;
  }

  fetch('vendas.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/json'},
    body: JSON.stringify(novosDados)
  })
  .then(res => res.json())
  .then(data => { alert(data.mensagem); console.log(data); })
  .catch(err => { console.error(err); alert("Ocorreu um erro ao salvar a tabela."); });
}

function carregarTabela() {
  let dados = vendasBD.length ? vendasBD : JSON.parse(localStorage.getItem("vendas") || "[]");
  for (let linha of dados) { adicionarLinha(linha); }
}

function atualizarStatus(select) {
  if (select.value === "Negociando") {
    select.classList.add("negociando"); select.classList.remove("finalizado");
  } else if (select.value === "Finalizado") {
    select.classList.add("finalizado"); select.classList.remove("negociando");
  } else {
    select.classList.remove("negociando", "finalizado");
  }
}
</script>
</body>
</html>
