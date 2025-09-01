<?php
// CREATE TABLE modulo (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     nome VARCHAR(255) NOT NULL,
//     id_campo INT NOT NULL,
//     id_empresa INT NOT NULL,
//     FOREIGN KEY (id_campo) REFERENCES campo(id),
//     FOREIGN KEY (id_empresa) REFERENCES empresa(id)
// ) ENGINE=InnoDB;

class Modulo
{
    private ?int $id;
    private string $nome;  
    private int $idCampo;
    private int $idEmpresa;
    

    public function __construct($id, $nome, $idCampo, $idEmpresa)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->idCampo = $idCampo;
        $this->idEmpresa = $idEmpresa;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getIdCampo()
    {
        return $this->idCampo;
    }

    public function getIdEmpresa()
    {
        return $this->idEmpresa;
    }
}

?>