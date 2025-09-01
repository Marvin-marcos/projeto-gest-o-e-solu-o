<?php

session_start();

if (!isset($_SESSION['token'])) {
    header('Location: cadastro/Cadastro.php'); // Redirecionar para a página de cadastro se não estiver autenticado
    exit();
    
}


?>

CREATE TABLE valor (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    valor DECIMAL(10,2) NOT NULL,
    id_campo INT,
    id_empresa INT
);
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados</title>
    <link rel="stylesheet" href="../../css/login.css">
</head>
<body>
    <form action="Adicionardados.php" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="valor">Valor:</label>
        <input type="number" step="0.01" id="valor" name="valor" required><br><br>

        <label for="campo">Campo:</label>
        <select id="campo" name="campo" required>
            <option value="">Selecione um campo</option>
            <!-- Opções de campos serão carregadas aqui -->
        </select><br><br>

        <button type="submit">Adicionar Dados</button>
    </form>
</body>
</html>