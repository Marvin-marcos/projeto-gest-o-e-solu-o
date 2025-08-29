

<?php
// CREATE TABLE vendas_flexivel (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     id_empresa INT,
//     dados_venda JSON,
//     FOREIGN KEY (id_empresa) REFERENCES empresa(id)
// );

class Vendas
{
    private ?int $id;
    private ?int $id_empresa;
    private ?array $dados_venda;

    public function __construct($id = null, $id_empresa = null, $dados_venda = null)
    {
        $this->id = $id;
        $this->id_empresa = $id_empresa;
        $this->dados_venda = $dados_venda;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getIdEmpresa(): ?int
    {
        return $this->id_empresa;
    }
    public function getDadosVenda(): ?array
    {
        return $this->dados_venda;
    }
    public function setIdEmpresa(int $id_empresa): void
    {
        $this->id_empresa = $id_empresa;
    }
    public function setDadosVenda(array $dados_venda): void
    {
        $this->dados_venda = $dados_venda;
    }
    public function toJson(): string
    {
        return json_encode($this->dados_venda);
    }
    public static function fromJson(string $json): array
    {
        return json_decode($json, true);
    }
}
