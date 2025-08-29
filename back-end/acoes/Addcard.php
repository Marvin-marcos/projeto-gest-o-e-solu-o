<!-- CREATE TABLE cards (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    id_modulo INT NOT NULL,
    FOREIGN KEY (id_modulo) REFERENCES modulo(id) ON DELETE CASCADE
)ENGINE=InnoDB;
  -->
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Conexão com o banco de dados
   $titulo = $_POST['titulo'];
   $id_modulo = $_POST['id_modulo'];

    
     require_once __DIR__ . '/../database/database.php';
     require_once __DIR__ . '/../model/Card.php';
     require_once __DIR__ . '/../dao/CardDAO.php';
    
     $card = new Card(null, $titulo, $id_modulo);
     $cardDAO = new CardDAO();
    
     if ($cardDAO->cadastrarCard($card)) {
          header('Location: ../home.php?id_tabela='.$id_modulo); // Redirecionar para a página inicial após o cadastro
          exit();
     } else {
          echo "Erro ao cadastrar card.";
          exit();
     }
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/login.css">
</head>
<body>
    <form action="Addcard.php" method="POST">
        <h1>Adicionar Card</h1>
        <label for="titulo"></label>
        <input type="text" name="titulo" placeholder="Titulo" required>

        <input type="hidden" name="id_modulo" value="<?php echo $_GET['id_tabela']; ?>">
        <button type="submit">Adicionar</button>
    </form>
</body>
</html>