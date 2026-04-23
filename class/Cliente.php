<?php 

    // Pega o caminho real da pasta onde este arquivo Cliente.php está
    $diretorio_atual = dirname(__FILE__); 
    // Sobe uma pasta e entra em config/conexao.php
    include_once $diretorio_atual . "/../config/conexao.php";

    class Cliente {
    private $id;
    private $usuario_id;
    private $telefone;
    private $cpf;
    private $pdo;

    public function __construct($pdo_externo = null) {
        // Se passar o PDO por fora, ele usa, senão tenta o global
        $this->pdo = $pdo_externo;
    }

    public function setUsuarioId($id) { $this->usuario_id = $id; }
    public function setTelefone($t) { $this->telefone = $t; }
    public function setCpf($c) { $this->cpf = $c; }
    public function getId() { return $this->id; }

    public function inserir(): bool {
        $sql = "INSERT INTO clientes (usuario_id, telefone, cpf) VALUES (:u, :t, :c)";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":u", $this->usuario_id);
        $cmd->bindValue(":t", $this->telefone);
        $cmd->bindValue(":c", $this->cpf);
        if($cmd->execute()){
            $this->id = $this->pdo->lastInsertId();
            return true;
        }
        return false;
    }

    public static function listar($pdo_externo): array {
        $cmd = $pdo_externo->query("SELECT * FROM clientes ORDER BY id DESC");
        return $cmd->fetchAll(PDO::FETCH_ASSOC);
    }
}