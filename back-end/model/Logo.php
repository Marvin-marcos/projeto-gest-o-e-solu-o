<?php
// CREATE TABLE imagens (
//   id INT AUTO_INCREMENT PRIMARY KEY,
//   nome VARCHAR(255) NOT NULL,
//   caminho VARCHAR(255) NOT NULL,
//   criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
// );

class Logo {
    private ?int $id;
    private string $nome;
    private string $caminho;
    private ?string $criado_em;

    public function __construct(?int $id, string $nome, string $caminho, ?string $criado_em) {
        $this->id = $id;
        $this->nome = $nome;
        $this->caminho = $caminho;
        $this->criado_em = $criado_em;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function getCaminho(): string {
        return $this->caminho;
    }

    public function getCriadoEm(): ?string {
        return $this->criado_em;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setNome(string $nome): void {
        $this->nome = $nome;
    }

    public function setCaminho(string $caminho): void {
        $this->caminho = $caminho;
    }

    public function setCriadoEm(string $criado_em): void {
        $this->criado_em = $criado_em;
    }
}




?>