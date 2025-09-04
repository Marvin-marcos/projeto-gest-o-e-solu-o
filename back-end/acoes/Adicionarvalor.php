<?php
require_once __DIR__ .'/../model/Valor.php';
require_once __DIR__ .'/../dao/ValorDAO.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $id_submodulo = $_POST['id_submodulo'];
    $valorInput = $_POST["valor"];
    $id_modulo = $_POST["id_modulo"];
    


    $valorObj = new Valor(null , $valorInput,$id_submodulo);
 

    $valordao = new ValorDAO();
    $valordao->create($valorObj);
    header("LOcation: Adicionarsubmodulo.php?id_modulo=".$id_modulo);

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Valor</title>
    <link rel="stylesheet" href="../../css/login.css">
</head>
<body>
    <form action="AdicionarValor.php" method="POST">
        <input hidden type="number" name="id_submodulo" value="<?= $_GET['id_submodulo'] ?? '' ?>" required>
        <input hidden type="number" name="id_modulo" value="<?= $_GET['id_modulo'] ?? '' ?>" required>
        <label for="valor">Digite o Valor</label>
        <input type="text" name="valor" required>
       
        <button type="submit">Salvar</button>
    </form>
</body>
</html>
