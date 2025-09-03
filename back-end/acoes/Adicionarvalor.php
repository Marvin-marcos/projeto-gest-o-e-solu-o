<?php

// -- Tabela 2: Item do submódulo (com nome)
// CREATE TABLE item_submodulo (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     nome VARCHAR(255) NOT NULL,
//     id_submodulo INT NOT NULL,
//     FOREIGN KEY (id_submodulo) REFERENCES submodulo(id)
// ) ENGINE=InnoDB;

// -- Tabela 3: Valor do submódulo (com valor int)
// CREATE TABLE valor_submodulo (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     valor INT NOT NULL,
//     id_submodulo INT NOT NULL,
//     FOREIGN KEY (id_submodulo) REFERENCES submodulo(id)
// ) ENGINE=InnoDB;




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Valor</title>
</head>
<body>
    <form action="Adicionarvalor.php" method="POST">
        <input type="number" value="<?= $_GET['id_submodulo'] ?>">
        <label for="valor">Digite o Valor</label>
        <input type="text" name="valor">
        <select name="textoounumero" id="textoounumero">
            <option value="numero">Numero</option>
            <option value="Texto">Texto</option>
        </select>


    </form>
</body>
</html>