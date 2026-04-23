<?php
include_once __DIR__ . "/../config/conexao.php";

class Servico {
    private $id;
    private $nome;
    private $descricao;
    private $preco;
    private $descontinuado;
    private $pdo;

    public function __construct() {
        $this->pdo = obterPdo();
    }

    // Getters e Setters
    public function getId() { return $this->id; }
    public function getNome() { return $this->nome; }
    public function setNome($nome) { $this->nome = $nome; }
    public function getDescricao() { return $this->descricao; }
    public function setDescricao($desc) { $this->descricao = $desc; }
    public function getPreco() { return $this->preco; }
    public function setPreco($preco) { $this->preco = $preco; }
    public function getDescontinuado() { return $this->descontinuado; }
    public function setDescontinuado($d) { $this->descontinuado = $d; }

    public function inserir(): bool {
        $sql = "INSERT INTO servicos (nome, descricao, preco, descontinuado) VALUES (:n, :d, :p, b'0')";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":n", $this->nome);
        $cmd->bindValue(":d", $this->descricao);
        $cmd->bindValue(":p", $this->preco);
        return $cmd->execute();
    }

    public static function listar(): array {
        $cmd = obterPdo()->query("SELECT * FROM servicos ORDER BY nome ASC");
        return $cmd->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function listarAtivos(): array {
        $cmd = obterPdo()->query("SELECT * FROM servicos WHERE descontinuado = b'0' ORDER BY nome ASC");
        return $cmd->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId(int $id): bool {
        $cmd = $this->pdo->prepare("SELECT * FROM servicos WHERE id = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        if($dados = $cmd->fetch(PDO::FETCH_ASSOC)) {
            $this->id = $dados['id'];
            $this->nome = $dados['nome'];
            $this->preco = $dados['preco'];
            $this->descontinuado = $dados['descontinuado'];
            return true;
        }
        return false;
    }

    public function atualizar(): bool {
        $sql = "UPDATE servicos SET nome=:n, descricao=:d, preco=:p WHERE id=:id";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":n", $this->nome);
        $cmd->bindValue(":d", $this->descricao);
        $cmd->bindValue(":p", $this->preco);
        $cmd->bindValue(":id", $this->id);
        return $cmd->execute();
    }

    public function excluir(int $id): bool {
        $cmd = $this->pdo->prepare("UPDATE servicos SET descontinuado = b'1' WHERE id = :id");
        $cmd->bindValue(":id", $id);
        return $cmd->execute();
    }
}