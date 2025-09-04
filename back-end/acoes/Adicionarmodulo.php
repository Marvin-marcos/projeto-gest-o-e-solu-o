<!-- CREATE TABLE modulo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    valor DECIMAL(10, 2),
    id_campo INT NOT NULL,
    id_empresa INT NOT NULL,
    id_modulo INT NOT NULL,
    FOREIGN KEY (id_campo) REFERENCES campo(id),
    FOREIGN KEY (id_empresa) REFERENCES empresa(id)
); -->
<?php
session_start();

require_once __DIR__ . '/../dao/CampoDAO.php';
require_once __DIR__ . '/../model/Campo.php';

$campoDAO = new CampoDAO();
$campo = $campoDAO->buscarCampoPorId($_GET['id_campo'] ?? 0);

if (!isset($_SESSION['token'])) {
    header('Location: ../cadastro/Cadastro.php'); // Redirecionar para a página de cadastro se não estiver autenticado
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $id_campo = $_POST['id_campo'] ?? '';
    $id_empresa = $_POST['id_empresa'] ?? '';

    if ($nome && $id_campo && $id_empresa) {

    
        require_once __DIR__ . '/../model/Modulo.php';
        require_once __DIR__ . '/../dao/ModuloDAO.php';
        $moduloDAO = new ModuloDAO();
        $modulo = new Modulo(null, $nome, (int)$id_campo, (int)$id_empresa);
        if($moduloDAO->adicionarModulo($modulo)){
            header('Location: ../home.php?id='.$id_campo);
            exit();
        } else {
            echo "Erro ao cadastrar módulo.";
        }

       
    }else {
        echo "Todos os campos são obrigatórios.";
    }



}





?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campo</title>
    <link rel="stylesheet" href="../../css/login.css">
</head>
<body>
    
    <form action="Adicionarmodulo.php" method="POST">
        <h1>Adicionar <?= $campo->getNome(); ?></h1>
        <label for="nome">Nome do Modulo:</label>
        <input type="text" id="nome" name="nome" required><br><br>

       
        <input hidden type="number" id="id_campo" name="id_campo" value="<?= $_GET['id_campo'] ?>"><br><br>

        <input hidden name="id_empresa" value="<?=$_SESSION['id_empresa']; ?>">

        <input type="submit" value="Adicionar Modulo">
    
    </form>
</body>
</html>