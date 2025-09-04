<?php

class SubmoduloItem {
    private int $id_submodulo;
    private string $nome_submodulo;
    private int $id_modulo;
    private ?int $id_item;      // Pode ser null se não houver item
    private ?string $nome_item; // Pode ser null se não houver item

    public function __construct(
        int $id_submodulo = 0,
        string $nome_submodulo = '',
        int $id_modulo = 0,
        ?int $id_item = null,
        ?string $nome_item = null
    ) {
        $this->id_submodulo = $id_submodulo;
        $this->nome_submodulo = $nome_submodulo;
        $this->id_modulo = $id_modulo;
        $this->id_item = $id_item;
        $this->nome_item = $nome_item;
    }

    // --- Getters ---
    public function getIdSubmodulo(): int {
        return $this->id_submodulo;
    }

    public function getNomeSubmodulo(): string {
        return $this->nome_submodulo;
    }

    public function getIdModulo(): int {
        return $this->id_modulo;
    }

    public function getIdItem(): ?int {
        return $this->id_item;
    }

    public function getNomeItem(): ?string {
        return $this->nome_item;
    }

    // --- Setters ---
    public function setIdSubmodulo(int $id_submodulo): void {
        $this->id_submodulo = $id_submodulo;
    }

    public function setNomeSubmodulo(string $nome_submodulo): void {
        $this->nome_submodulo = $nome_submodulo;
    }

    public function setIdModulo(int $id_modulo): void {
        $this->id_modulo = $id_modulo;
    }

    public function setIdItem(?int $id_item): void {
        $this->id_item = $id_item;
    }

    public function setNomeItem(?string $nome_item): void {
        $this->nome_item = $nome_item;
    }
}
