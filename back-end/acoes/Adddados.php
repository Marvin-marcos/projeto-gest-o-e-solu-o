<!-- CREATE TABLE dados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    valor VARCHAR(255) NOT NULL,
    id_card INT NOT NULL,
    FOREIGN KEY (id_card) REFERENCES cards(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB; -->


<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Conexão com o banco de dados
   $valor = $_POST['valor'];
   $id_card = $_POST['id_card'];
   $id_tabela = $_POST['id_tabela'];
   echo "teste";

    
     
     require_once __DIR__ . '/../model/Dados.php';
     require_once __DIR__ . '/../dao/DadosDAO.php';
     
    
     $dados = new Dados(null, $valor, $id_card);
     $dadosDAO = new DadosDAO();
    
        if ($dadosDAO->cadastrarDado($dados)) {
            header('Location: ../home.php?id_tabela='.$id_tabela); // Redirecionar para a página inicial após o cadastro
            exit();
        } else {
            echo "Erro ao cadastrar dado.";
            exit();
        }

    }
     



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados</title>
    <link rel="stylesheet" href="../../css/login.css">
</head>
<body>
    <form action="Adddados.php" method="POST">
        <h1>Adicionar Dado</h1>
        <label for="valor"></label>
        <input type="text" name="valor" placeholder="Valor" required>

        <input type="hidden" name="id_card" value="<?= $_GET['id_card']; ?>">

        <input type="hidden" name="id_tabela" value="<?= $_GET['id_tabela']; ?>">
        
        <button type="submit">Adicionar</button>

    </form>
    
</body>
</html>