<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if ($email && $senha) {
        require_once __DIR__ . '/../database/database.php';
        require_once __DIR__ . '/../model/Empresa.php';
        require_once __DIR__ . '/../dao/EmpresaDAO.php';

        $empresaDAO = new EmpresaDAO();
        $empresa = $empresaDAO->buscarEmpresaPorEmail($email);

        

        if ($empresa && password_verify($senha, $empresa->getSenha())) {
            $_SESSION['token'] = $empresa->getToken();
            header('Location: ../home.php');
            $_SESSION['id_empresa'] = $empresa->getIdEmpresa();
            exit();
        } else {
            echo "Email ou senha inválidos.";
            
        }
    } else {
        echo "Todos os campos são obrigatórios.";
        
        
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
    <form action="Login.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        
        <button type="submit">Entrar</button>
        <a href="Cadastro.php">Cadastrar Empresa
    </a>
    </form>
    
    
</body>
</html>