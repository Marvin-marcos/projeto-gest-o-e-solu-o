<?php
class Valor {
    private ?int $id;          // id da tabela, pode ser null
    private string|int $valor; // pode ser texto ou número
    private int $id_submodulo; // referência para submódulo

    // Construtor
    public function __construct(?int $id = null ,string|int $valor, int $id_submodulo, ) {
        $this->valor = $valor;
        $this->id_submodulo = $id_submodulo;
        $this->id = $id;
    }

    // --- GETTERS ---
    public function getId(): ?int {
        return $this->id;
    }

    public function getValor(): string|int {
        return $this->valor;
    }

    public function getIdSubmodulo(): int {
        return $this->id_submodulo;
    }

    // --- SETTERS ---
    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setValor(string|int $valor): void {
        $this->valor = $valor;
    }

    public function setIdSubmodulo(int $id_submodulo): void {
        $this->id_submodulo = $id_submodulo;
    }
}
