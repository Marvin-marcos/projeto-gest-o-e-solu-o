<?php
require_once __DIR__ .'/../model/Valor.php';
require_once __DIR__ .'/../dao/ValorDAO.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $id_submodulo = $_POST['id_submodulo'];
    $valorInput = $_POST["valor"];
    $tipo = $_POST["textoounumero"];


    $valorObj = new Valor(null , $valorInput,$id_submodulo);
 

    $valordao = new ValorDAO();
    $valordao->create($valorObj, $tipo);

    echo ucfirst($tipo) . " salvo com sucesso!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Valor</title>
</head>
<body>
    <form action="AdicionarValor.php" method="POST">
        <input hidden type="number" name="id_submodulo" value="<?= $_GET['id_submodulo'] ?? '' ?>" required>
        <label for="valor">Digite o Valor</label>
        <input type="text" name="valor" required>
        <select name="textoounumero" id="textoounumero">
            <option value="numero">Número</option>
            <option value="texto">Texto</option>
        </select>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>
