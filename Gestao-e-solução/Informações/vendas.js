let colunaIndex = null;

// Carregar dados salvos ao iniciar
window.onload = function() {
  carregarTabela();
}

// Abre modal
function abrirModal() {
  document.getElementById("modalColuna").style.display = "flex";
  document.getElementById("nomeColunaInput").value = "";
  colunaIndex = document.getElementById("statusHeader").cellIndex + 1;
}

// Fecha modal
function fecharModal() {
  document.getElementById("modalColuna").style.display = "none";
}

// Confirma e adiciona coluna
function confirmarColuna() {
  let nomeColuna = document.getElementById("nomeColunaInput").value.trim();
  if (!nomeColuna) {
    alert("Digite um nome para a coluna!");
    return;
  }

  let tabela = document.getElementById("tabelaVendas");
  let headerRow = document.getElementById("headerRow");

  // Adiciona no cabeçalho
  let novoTh = document.createElement("th");
  novoTh.textContent = nomeColuna;
  headerRow.insertBefore(novoTh, headerRow.cells[colunaIndex]);

  // Adiciona nas linhas existentes
  for (let i = 1; i < tabela.rows.length; i++) {
    let novaCelula = tabela.rows[i].insertCell(colunaIndex);
    novaCelula.innerHTML = `<input type="text">`;
  }

  fecharModal();
}

// Adiciona nova linha
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
        </select>
      `;
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

// Salvar tabela no localStorage
function salvarTabela() {
  let tabela = document.getElementById("tabelaVendas");
  let headers = [];
  let dados = [];

  // Pega os nomes das colunas
  for (let th of tabela.rows[0].cells) {
    headers.push(th.innerText);
  }

  // Pega os valores das linhas
  for (let i = 1; i < tabela.rows.length; i++) {
    let row = tabela.rows[i];
    let linhaDados = {};

    for (let j = 0; j < row.cells.length; j++) {
      let celula = row.cells[j];
      let input = celula.querySelector("input, select");
      linhaDados[headers[j]] = input ? input.value : "";
    }

    dados.push(linhaDados);
  }

  localStorage.setItem("vendas", JSON.stringify(dados));
  alert("Tabela salva com sucesso!");
}

// Carrega tabela do localStorage
function carregarTabela() {
  let dados = JSON.parse(localStorage.getItem("vendas") || "[]");
  for (let linha of dados) {
    adicionarLinha(linha);
  }
}

// Atualiza a cor do select dependendo do valor
function atualizarStatus(select) {
  if (select.value === "Negociando") {
    select.classList.add("negociando");
    select.classList.remove("finalizado");
  } else if (select.value === "Finalizado") {
    select.classList.add("finalizado");
    select.classList.remove("negociando");
  } else {
    select.classList.remove("negociando", "finalizado");
  }
}
