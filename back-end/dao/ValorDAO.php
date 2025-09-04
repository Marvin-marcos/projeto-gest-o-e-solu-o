<?php
require_once __DIR__ ."/../database/database.php";
require_once __DIR__ ."/../model/Valor.php";

class ValorDAO
{

     private $conn;

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

    // --- CREATE ---
    public function create(Valor $valor): bool
    {
        $sql = "INSERT INTO item_submodulo (nome, id_submodulo) VALUES (:nome, :id_submodulo)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(':nome', $valor->getValor(), PDO::PARAM_STR);
        $stmt->bindValue(':id_submodulo', $valor->getIdSubmodulo(), PDO::PARAM_INT);

        return $stmt->execute();
    }

    // --- READ ---
    public function getById(int $id): ?array
    {
        $sql = "SELECT * FROM item_submodulo WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM item_submodulo";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // --- UPDATE ---
    public function update(Valor $valor): bool
    {
        $sql = "UPDATE item_submodulo 
                   SET nome = :nome, id_submodulo = :id_submodulo 
                 WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(':nome', $valor->getValor(), PDO::PARAM_STR);
        $stmt->bindValue(':id_submodulo', $valor->getIdSubmodulo(), PDO::PARAM_INT);
        $stmt->bindValue(':id', $valor->getId(), PDO::PARAM_INT);

        return $stmt->execute();
    }

    // --- DELETE ---
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM item_submodulo WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    //     CREATE TABLE IF NOT EXISTS valor_submodulo (
    //     id INT AUTO_INCREMENT PRIMARY KEY,
    //     valor INT NOT NULL,
    //     id_submodulo INT NOT NULL,
    //     FOREIGN KEY (id_submodulo) REFERENCES submodulo(id)
    // ) ENGINE=InnoDB;

    public function getBySubModulos(int $id): array
{
    $sql = 'SELECT * FROM item_submodulo WHERE id_submodulo = :id';
    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $valores = [];

    foreach ($resultados as $row) {
        // Ajuste aqui: a coluna 'nome' é o valor que você quer
        $valores[] = new Valor(
            $row['id'],       // id do item
            $row['nome'],     // nome do item como valor
            $row['id_submodulo']
        );
    }

    return $valores;
}


}
