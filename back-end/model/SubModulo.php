<?php
class Submodulo {
    private $id;
    private $nome;
    private $id_modulo;

    // Construtor
    public function __construct($nome = null, $id_modulo = null, $id = null) {
        $this->id = $id;
        $this->nome = $nome;
        $this->id_modulo = $id_modulo;
    }

    // Getters e Setters
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getIdModulo() {
        return $this->id_modulo;
    }

    public function setIdModulo($id_modulo) {
        $this->id_modulo = $id_modulo;
    }
}
?>
