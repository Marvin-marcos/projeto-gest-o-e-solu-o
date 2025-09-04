<?php




// CREATE TABLE submodulo (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     nome VARCHAR(255) NOT NULL,
//     id_modulo INT NOT NULL,
//     FOREIGN KEY (id_modulo) REFERENCES modulo(id)
// ) ENGINE=InnoDB;



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../model/SubModulo.php';
    require_once '../dao/SubModuloDAO.php';

    $nome = $_POST['nome'];
    $id_modulo = $_POST['id_modulo'];

    $submodulo = new Submodulo($nome, $id_modulo);
    $submoduloDAO = new SubmoduloDAO();

    if ($submoduloDAO->create($submodulo)) {
        header("Location: Adicionarsubmodulo.php?id_modulo=" . $id_modulo);
        exit();
    } else {
        echo "Erro ao adicionar submódulo.";
    }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Itens</title>
    <link rel="stylesheet" href="../../css/login.css">
</head>
<body>
    <form action="Adicionaritensubmodulo.php" method="POST">
        <input type="number" hidden name="id_modulo" value="<?= $_GET['id_modulo']; ?>">

        <label for="nome">Nome do Campo:</label>
        <input type="text" id="nome" name="nome" required>

        <button type="submit">Adicionar</button>
        

    </form>
    
</body>
</html>