<?php
include_once __DIR__ . "/../config/conexao.php";

class Solicitacao {
    private $id;
    private $cliente_id;
    private $descricao_problema;
    private $status;
    private $pdo;

    public function __construct() {
        $this->pdo = obterPdo();
    }

    // Métodos Obrigatórios
    public function inserir(): bool {
        $sql = "INSERT INTO solicitacoes (cliente_id, descricao_problema, status, data_cad) 
                VALUES (:cid, :desc, 1, NOW())";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":cid", $this->cliente_id);
        $cmd->bindValue(":desc", $this->descricao_problema);
        if($cmd->execute()) {
            $this->id = $this->pdo->lastInsertId();
            return true;
        }
        return false;
    }

    public static function listarPorCliente(int $cliente_id): array {
        $cmd = obterPdo()->prepare("SELECT * FROM solicitacoes WHERE cliente_id = :cid ORDER BY data_cad DESC");
        $cmd->bindValue(":cid", $cliente_id);
        $cmd->execute();
        return $cmd->fetchAll(PDO::FETCH_ASSOC);
    }

    public function responder(string $resposta, int $status): bool {
        $sql = "UPDATE solicitacoes SET resposta_admin = :res, status = :st, data_resposta = NOW() WHERE id = :id";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":res", $resposta);
        $cmd->bindValue(":st", $status);
        $cmd->bindValue(":id", $this->id);
        return $cmd->execute();
    }

    // Getters/Setters necessários
    public function setClienteId($id) { $this->cliente_id = $id; }
    public function setDescricaoProblema($desc) { $this->descricao_problema = $desc; }
    public function getId() { return $this->id; }
}