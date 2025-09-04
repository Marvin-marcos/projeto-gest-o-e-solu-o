<?php
require_once __DIR__ . '/database/database.php';
require_once __DIR__ . '/model/Valor.php';
require_once __DIR__ . '/dao/ValorDAO.php';
require_once __DIR__ . '/dao/SubModuloDAO.php';

// --- TESTE DE CONEXÃO ---
try {
    $conn = Database::getConnection();
    echo "✅ Conexão com o banco OK!<br>";
} catch (PDOException $e) {
    die("❌ Erro de conexão: " . $e->getMessage());
}

// --- TESTE DE SUBMODULOS ---
$submoduloDAO = new SubModuloDAO();
$submodulos = $submoduloDAO->getPorIdModulo(1); // Coloque um id_modulo existente

echo "<h2>Submódulos do módulo 1</h2>";
echo "<pre>";
print_r($submodulos);
echo "</pre>";

// --- TESTE DE VALORES ---
$valorDAO = new ValorDAO();

foreach ($submodulos as $submodulo) {
    echo "<h3>Valores do Submódulo: " . $submodulo->getNome() . "</h3>";

    $valores = $valorDAO->getBySubModulos($submodulo->getId());

    if (empty($valores)) {
        echo "❌ Nenhum valor encontrado para este submódulo!<br>";
    } else {
        foreach ($valores as $valor) {
            echo "Valor ID " . $valor->getId() . ": " . $valor->getValor() . "<br>";
        }
    }

    echo "<hr>";
}
