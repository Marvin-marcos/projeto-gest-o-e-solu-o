<?php

session_start();


if (!isset($_SESSION['token'])) {
    header('Location: cadastro/Cadastro.php'); // Redirecionar para a página de cadastro se não estiver autenticado
    exit();
    echo "Você não está autenticado. Por favor, faça o cadastro.";
}
require_once __DIR__ . '/dao/CampoDAO.php';
require_once __DIR__ . '/model/Campo.php';
require_once __DIR__ . '/dao/ModuloDAO.php';
require_once __DIR__ . '/model/Modulo.php';
require_once __DIR__ . '/dao/CardDAO.php';
require_once __DIR__ . '/model/Card.php';
require_once __DIR__ . '/dao/DadosDAO.php';
require_once __DIR__ . '/model/Dados.php';
require_once __DIR__ . '/dao/EmpresaDAO.php';
require_once __DIR__ . '/model/Empresa.php';
require_once __DIR__ . '/dao/ImagemController.php';
require_once __DIR__ . '/model/Logo.php';






$camposDAO = new CampoDAO();
$dadosDAO = new DadosDAO();
$cardsDAO = new CardDAO();
$moduloDAO = new ModuloDAO();
$empresaDAO = new EmpresaDAO();
$logoController = new ImagemController();


$logo = $logoController->getImagemPorEmpresa($_SESSION['id_empresa']);
$campos = $camposDAO->listarCamposPorEmpresa($_SESSION['id_empresa']);
$empresa = $empresaDAO->buscarEmpresaPorId($_SESSION['id_empresa']);



$cards = [];
$modulos = [];
$dados = [];

if (isset($_GET['id_tabela'])) {
    $id_modulo = $_GET['id_tabela'];
    $cards = $cardsDAO->listarCardsPorModulo($id_modulo);
} else {
    $modulos = $moduloDAO->listarModulosPorEmpresa($_SESSION['id_empresa']);
}
if (isset($_GET['id'])) {
    $id_campo = $_GET['id'];
    $modulos = $moduloDAO->listarModulosPorCampo($id_campo, $_SESSION['id_empresa']);
}

$logoPath = ($logo && file_exists($logo->getCaminho()))
    ? $logo->getCaminho()
    : "https://static.vecteezy.com/ti/vetor-gratis/p1/5538023-forma-simples-montanha-preto-branco-circulo-logo-simbolo-icone-design-grafico-ilustracao-ideia-criativo-vetor.jpg";



?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão & Solução</title>
    <link rel="stylesheet" href="../css/styles3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <div class="container">
        <header class="header">
            <div class="logo">
                <a href="configuracao.php">
                    <img src="<?= $logoPath ?>" alt="Logo">
                </a>
                <div class="menu-toggle">
                    <i class="fas fa-bars"></i>
                </div>
            </div>
            <div class="title">
                <h1> <?= $empresa ? $empresa->getNome() : "Gestão & Solução" ?></h1>
            </div>
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Pesquisa">
            </div>


        </header>


        <aside class="sidebar">
            <?php foreach ($campos as $campo): ?>
                <a href="?id=<?= $campo->getIdCampo(); ?>">
                    <nav>
                        <ul>
                            <li style="box-shadow: 3px 3px 1px <?= $campo->getCor(); ?>;border: 1px solid black">
                                <?= $campo->getNome(); ?>
                            </li>
                        </ul>
                    </nav>
                </a>
            <?php endforeach; ?>
            <div class="add-button">
                <a href="acoes/Addcampo.php"><i class="fas fa-plus-circle"></i></a>
            </div>
        </aside>


        <main class="main-content">

            <!-- modulos -->
            <ul>
                <?php foreach ($modulos as $modulo): ?>
                    <li><a href="?id_tabela=<?= $modulo->getId(); ?>"><?= $modulo->getNome(); ?></a></li>
                <?php endforeach; ?>
            </ul>

            <!-- cards -->
            <div class="cards-table">
                <?php foreach ($cards as $card): ?>
                    <div class="card">
                        <h3><?= $card->getTitulo(); ?></h3>
                        <?php foreach ($dadosDAO->buscarDadosPorCard($card->getId()) as $dado): ?>
                            <p><?= $dado->getValor(); ?></p>
                        <?php endforeach; ?>
                        <a href="acoes/Adddados.php?id_card=<?= $card->getId() ?>&id_tabela=<?= $_GET['id_tabela'] ?>">Adicionar</a>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- adicionar campo -->

            <?php if (isset($_GET['id'])): ?>
                <a href="acoes/Adicionarmodulo.php?id_campo=<?= $_GET['id']; ?>">Adicionar</a>
            <?php endif; ?>
            <!-- adicionar tabela -->

            <?php if (isset($_GET['id_tabela'])): ?>
                <a href="acoes/Addcard.php?id_tabela=<?= $_GET['id_tabela'] ?>">Adicionar</a>
            <?php endif; ?>

        </main>
    </div>

    <script>
        const toggleBtn = document.querySelector(".menu-toggle");
        const sidebar = document.querySelector(".sidebar");

        toggleBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
        });
    </script>


</body>

</html>