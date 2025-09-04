<?php

// Estrutura da tabela (se precisar rodar no MySQL):
// CREATE TABLE vendas_flexivel (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     id_empresa INT NOT NULL,
//     dados_venda JSON NOT NULL,
//     FOREIGN KEY (id_empresa) REFERENCES empresa(id)
// );

require_once __DIR__ . '/../database/database.php';

class VendasDAO
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

    /**
     * Salvar venda no banco
     */
    public function salvarVendas($id_empresa, $dados_venda)
    {
        try {
            $sql = "INSERT INTO vendas_flexivel (id_empresa, dados_venda) 
                    VALUES (:id_empresa, :dados_venda)";
            $stmt = $this->conn->prepare($sql);

            $jsonDados = json_encode($dados_venda, JSON_UNESCAPED_UNICODE);

            $stmt->bindParam(':id_empresa', $id_empresa, PDO::PARAM_INT);
            $stmt->bindParam(':dados_venda', $jsonDados, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao salvar venda: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Obter todas as vendas de uma empresa
     */
    public function obterVendasPorEmpresa($id_empresa)
    {
        try {
            $sql = "SELECT * FROM vendas_flexivel WHERE id_empresa = :id_empresa";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_empresa', $id_empresa, PDO::PARAM_INT);
            $stmt->execute();

            $vendas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Decodifica o JSON de cada venda
            foreach ($vendas as &$venda) {
                $venda['dados_venda'] = json_decode($venda['dados_venda'], true);
            }

            return $vendas;
        } catch (PDOException $e) {
            error_log("Erro ao buscar vendas: " . $e->getMessage());
            return [];
        }
    }


    function getSubmodulosComItens(int $id_modulo): array {
    $sql = "
        SELECT 
            s.id AS id_submodulo,
            s.nome AS nome_submodulo,
            s.id_modulo,
            i.id AS id_item,
            i.nome AS nome_item
        FROM submodulo s
        LEFT JOIN item_submodulo i ON s.id = i.id_submodulo
        WHERE s.id_modulo = :id_modulo
    ";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(':id_modulo', $id_modulo, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}
