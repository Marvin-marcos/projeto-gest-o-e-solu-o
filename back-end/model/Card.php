<!-- CREATE TABLE cards (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    id_modulo INT NOT NULL,
    FOREIGN KEY (id_modulo) REFERENCES modulo(id) ON DELETE CASCADE
); -->

<?php
class Card {
    private ?int $id;
    private string $titulo;
    private int $id_modulo;
   
    public function __construct($id, $titulo, $id_modulo) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->id_modulo = $id_modulo;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getIdModulo() {
        return $this->id_modulo;
    }
}

?>