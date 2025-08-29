<?php

session_start();
require_once __DIR__ . '/dao/ImagemController.php';

// Instancia o Controller
$controller = new ImagemController();

// Defina o ID da empresa que deseja associar à imagem
// Você pode obter isso do login do usuário ou outro contexto
$idEmpresa = $_SESSION['id_empresa']; // Exemplo fixo, substitua conforme necessário

if (isset($_POST['enviar'])) {
    if (isset($_FILES['imagem'])) {
        $caminho = $controller->atualizarImagem($_FILES['imagem'], $idEmpresa);
        if ($caminho) {
            header("Location: home.php");
            exit;
        } else {
            echo "<p>Ocorreu um erro ao enviar a imagem.</p>";
        }
    } else {
        echo "<p>Nenhuma imagem foi enviada.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Upload de Imagem</title>
    <link rel="stylesheet" href="../css/Login.css">
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <h2>Carregar Imagem</h2>
        <input type="file" name="imagem" accept="image/*" required>
        <button type="submit" name="enviar">Enviar</button>
    </form>
</body>
</html>
