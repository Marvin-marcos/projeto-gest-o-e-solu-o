<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Exemplo de Modal</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      text-align: center;
      padding: 50px;
    }

    /* Fundo escuro do modal */
    .modal {
      display: none; /* Escondido por padrão */
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background: rgba(0, 0, 0, 0.5);
    }

    /* Conteúdo do modal */
    .modal-content {
      background: #fff;
      margin: 15% auto;
      padding: 20px;
      border-radius: 10px;
      width: 300px;
      text-align: center;
      box-shadow: 0 5px 10px rgba(0,0,0,0.3);
    }

    /* Botão de fechar (X) */
    .close {
      color: #aaa;
      float: right;
      font-size: 20px;
      font-weight: bold;
      cursor: pointer;
    }
    .close:hover {
      color: red;
    }

    button {
      padding: 10px 20px;
      margin-top: 20px;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <h1>Exemplo de Modal</h1>
  <button id="openBtn">Abrir Modal</button>

  <!-- Estrutura do modal -->
  <div id="meuModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Título do Modal</h2>
      <p>Este é um modal simples feito em HTML, CSS e JS!</p>
      <button id="closeBtn">Fechar</button>
    </div>
  </div>

  <script>
    const modal = document.getElementById("meuModal");
    const openBtn = document.getElementById("openBtn");
    const closeBtn = document.getElementById("closeBtn");
    const closeX = document.querySelector(".close");

    // Abrir modal
    openBtn.onclick = () => modal.style.display = "block";

    // Fechar modal pelo botão
    closeBtn.onclick = () => modal.style.display = "none";

    // Fechar modal pelo X
    closeX.onclick = () => modal.style.display = "none";

    // Fechar clicando fora do modal
    window.onclick = (event) => {
      if (event.target === modal) {
        modal.style.display = "none";
      }
    };
  </script>
</body>
</html>
