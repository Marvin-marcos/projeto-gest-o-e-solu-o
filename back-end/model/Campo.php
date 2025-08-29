<!-- -- Tabela campo
CREATE TABLE campo (
    id_campo INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    nivel INT NOT NULL,
    cor VARCHAR(7), -- Ex: #FFFFFF
    id_empresa INT NOT NULL,
    FOREIGN KEY (id_empresa) REFERENCES empresa(id_empresa) ON DELETE CASCADE
); -->

<?php

class Campo {
    private ?int $id_campo;
    private string $nome;
    private ?string $descricao;
    private int $nivel;
    private ?string $cor;
    private int $id_empresa;

    public function __construct(?int $id_campo, string $nome, ?string $descricao, int $nivel, ?string $cor, int $id_empresa) {
        $this->id_campo = $id_campo;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->nivel = $nivel;
        $this->cor = $cor;
        $this->id_empresa = $id_empresa;
    }

    // Getters and Setters
    public function getIdCampo(): ?int {
        return $this->id_campo;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function getDescricao(): ?string {
        return $this->descricao;
    }

    public function getNivel(): int {
        return $this->nivel;
    }

    public function getCor(): ?string {
        return $this->cor;
    }

    public function getIdEmpresa(): int {
        return $this->id_empresa;
    }
}

?>