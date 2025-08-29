<?php

session_start();

require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/../model/Empresa.php';
require_once __DIR__ . '/../dao/EmpresaDAO.php';
require_once __DIR__ . '/../dao/CampoDAO.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $cnpj = $_POST['cnpj'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if ($nome && $email && $cnpj && $senha) {

        $token = bin2hex(random_bytes(16)); // Gerar um token aleatório
        $empresa = new Empresa(null, $nome, $email, $cnpj, $senha, $token);
        $cadastro = new EmpresaDAO();
        $campoDAO = new CampoDAO();

        $empresaExistenteEmail = $cadastro->buscarEmpresaPorEmail($email);
        $empresaExistenteCnpj  = $cadastro->buscarEmpresaPorCnpj($cnpj);

        if ($empresaExistenteEmail) {
            echo "Email já cadastrado.";
            echo '<a href="Cadastro.php"><button>Cadastrar</button></a>';
            echo '<a href="Login.php"><button>Login</button></a>';
            return;
        } elseif ($empresaExistenteCnpj) {
            echo "CNPJ já cadastrado.";
            echo '<a href="Cadastro.php"><button>Cadastrar</button></a>';
            echo '<a href="Login.php"><button>Login</button></a>';
            return;
        }


        if ($cadastro->cadastrarEmpresa($empresa)) {
            $_SESSION['token'] = $token;
            $_SESSION['id_empresa'] = $cadastro->buscarEmpresaPorEmail($email)->getIdEmpresa();
            $campoDAO->adicionarCamposPadrao($_SESSION['id_empresa']);
            header('Location: ../Logo.php'); // Redirecionar para uma página de sucesso
            exit();
        } else {
            echo "Erro ao cadastrar empresa.";
            header('Location: Cadastro.php'); // Redirecionar para uma página de sucesso
            exit();
        }
    } else {
        echo "Todos os campos são obrigatórios.";
        header('Location: Cadastro.php'); // Redirecionar para uma página de sucesso
        exit();
    }
}


// crie uma class de cadastro de empresa
// que pegue os dados do formulario e salve no banco de dados

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
    <form action="Cadastro.php" method="post">

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="cnpj">CNPJ:</label>
        <input type="text" id="cnpj" name="cnpj" required>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>

        <button type="submit">Cadastrar</button>
        <a href="Login.php">Login</a>

    </form>
    

</body>

</html>