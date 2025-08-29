<!-- CREATE TABLE dados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    valor VARCHAR(255) NOT NULL,
    id_card INT NOT NULL,
    FOREIGN KEY (id_card) REFERENCES cards(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB; -->
<?php
class Dados {
    private ?int $id;
    private string $valor;
    private int $id_card;
   
    public function __construct($id, $valor, $id_card) {
        $this->id = $id;
        $this->valor = $valor;
        $this->id_card = $id_card;
    }

    public function getId() {
        return $this->id;
    }

    public function getValor() {
        return $this->valor;
    }

    public function getIdCard() {
        return $this->id_card;
    }
}
