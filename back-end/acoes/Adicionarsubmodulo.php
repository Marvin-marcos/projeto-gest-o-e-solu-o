<?php

require_once __DIR__ . '/../dao/SubModuloDAO.php';
require_once __DIR__ . '/../model/SubModulo.php';

$submodulos = [];
if (isset($_GET['id_modulo'])) {
    $id_modulo = $_GET['id_modulo'];
    $submoduloDAO = new SubmoduloDAO();
    $submodulos = $submoduloDAO->getPorIdModulo($id_modulo); // Você pode implementar um método para buscar submódulos por módulo, se necessário
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submodulo</title>
</head>

<body>
    <?php foreach ($submodulos as $submodulo): ?>
        <div>
            <h3><?= $submodulo->getNome(); ?></h3>
            <a href="Adicionarvalor.php?id_submodulo=<?= $submodulo->getId(); ?>">Adicionar Valor</a>

        </div>
    <?php endforeach; ?>

    <a href="../home.php?id_modulo=<?= $_GET['id_modulo'] ?>">Voltar</a>
    <a href="Adicionaritensubmodulo.php?id_modulo=<?= $_GET['id_modulo'] ?>">Adicionar</a>


</body>

</html>