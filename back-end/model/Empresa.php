<?php

class Empresa{
//     CREATE TABLE empresa (
//     id_empresa INT AUTO_INCREMENT PRIMARY KEY,
//     nome VARCHAR(100) NOT NULL,
//     email VARCHAR(150) NOT NULL UNIQUE,
//     cnpj VARCHAR(18) NOT NULL UNIQUE,
//     senha VARCHAR(255) NOT NULL
// );

    private ?int $id_empresa;
    private string $nome;
    private string $email;
    private string $cnpj;
    private string $senha;
    private ?string $token;

    public function __construct(?int $id_empresa, string $nome, string $email, string $cnpj, string $senha, ?string $token) {
        $this->id_empresa = $id_empresa;
        $this->nome = $nome;
        $this->email = $email;
        $this->cnpj = $cnpj;
        $this->senha = $senha;
        $this->token = $token;
    }
    public function getIdEmpresa(): int {
        return $this->id_empresa;
    }
    public function getNome(): string {
        return $this->nome;
    }
    public function getEmail(): string {
        return $this->email;
    }
    public function getCnpj(): string {
        return $this->cnpj;
    }
    public function getSenha(): string {
        return $this->senha;
    }
    public function getToken(): ?string {
        return $this->token;
    }
    public function setIdEmpresa(int $id_empresa): void {
        $this->id_empresa = $id_empresa;
    }
    public function setNome(string $nome): void {
        $this->nome = $nome;
    }
    public function setEmail(string $email): void {
        $this->email = $email;
    }
    public function setCnpj(string $cnpj): void {
        $this->cnpj = $cnpj;
    }
    public function setSenha(string $senha): void {
        $this->senha = $senha;

    }
    public function setToken(string $token): void {
        $this->token = $token;
    }
}


