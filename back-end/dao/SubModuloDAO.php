<?php
require_once __DIR__. '/../model/SubModulo.php';
require_once __DIR__.  '/../database/database.php';
require_once __DIR__. '/../model/valorModelo.php';


class SubmoduloDAO
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

    // CREATE
    public function create(Submodulo $submodulo)
    {
        $sql = "INSERT INTO submodulo (nome, id_modulo) VALUES (:nome, :id_modulo)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":nome", $submodulo->getNome());
        $stmt->bindValue(":id_modulo", $submodulo->getIdModulo());
        return $stmt->execute();
    }

    // READ ALL
    public function getAll()
    {
        $sql = "SELECT * FROM submodulo";
        $stmt = $this->conn->query($sql);
        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new Submodulo($row['nome'], $row['id_modulo'], $row['id']);
        }
        return $result;
    }

    // READ BY ID
    public function getById($id)
    {
        $sql = "SELECT * FROM submodulo WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Submodulo($row['nome'], $row['id_modulo'], $row['id']);
        }
        return null;
    }

    // UPDATE
    public function update(Submodulo $submodulo)
    {
        $sql = "UPDATE submodulo SET nome = :nome, id_modulo = :id_modulo WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":nome", $submodulo->getNome());
        $stmt->bindValue(":id_modulo", $submodulo->getIdModulo());
        $stmt->bindValue(":id", $submodulo->getId(), PDO::PARAM_INT);
        return $stmt->execute();
    }

    // DELETE
    public function delete($id)
    {
        $sql = "DELETE FROM submodulo WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function getPorIdModulo($id_modulo)
    {
        $sql = "SELECT * FROM submodulo WHERE id_modulo = :id_modulo";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id_modulo", $id_modulo, PDO::PARAM_INT);
        $stmt->execute();
        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new Submodulo($row['nome'], $row['id_modulo'], $row['id']);
        }
        return $result;
    }

    function getSubmodulosComItens( int $id_modulo): array {
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
        ORDER BY s.id, i.id
    ";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(':id_modulo', $id_modulo, PDO::PARAM_INT);
    $stmt->execute();

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $submodulosItens = [];

    foreach ($rows as $row) {
        $submodulosItens[] = new SubmoduloItem(
            $row['id_submodulo'],
            $row['nome_submodulo'],
            $row['id_modulo'],
            $row['id_item'] ?? null,
            $row['nome_item'] ?? null
        );
    }

    return $submodulosItens;
}

}
