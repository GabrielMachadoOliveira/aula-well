<?php

    // incluir a conexão
    include_once "config/conexao.php";

    // declara a classe
    class Servico {

        // atributos
        private $id;
        private $nome;
        private $descricao;
        private $preco;
        private $descontinuado;
        private $pdo;

        // construtor
        public function __construct() {
            $this->pdo = obterPdo();
        }

        // Getters e Setters
        public function getId() { 
            
            return $this->id; 
        
        }

        //NOME
        public function getNome() { 
            
            return $this->nome; 
        
        }
        public function setNome($nome) { 
        
            $this->nome = $nome; 
        
        }
        
        //Descrição
        public function getDescricao() { 
            
            return $this->descricao; 
        
        }
        public function setDescricao($descricao) { 
            
            $this->descricao = $descricao; 
        
        }

        //PRECO
        public function getPreco() { 
            
            return $this->preco; 
        
        }
        public function setPreco($preco) { 
            
            $this->preco = $preco; 
        
        }

        //DESCONTINUADO
        public function getDescontinuado() {
            
            return $this->descontinuado; 
        
        }
        public function setDescontinuado($descontinuado) {

            $this->descontinuado = $descontinuado; 

        }

        // inserir
        public function inserir(): bool {
            $sql = "INSERT INTO servicos (nome, descricao, preco, descontinuado) VALUES (:nome, :descricao, :preco, :descontinuado)";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":nome", $this->nome);
            $cmd->bindValue(":descricao", $this->descricao);
            $cmd->bindValue(":preco", $this->preco);
            return $cmd->execute();
        }

        // LISTAR
        public static function listar(): array {

            $cmd = obterPdo()->query("SELECT * FROM servicos ORDER BY nome ASC");
            return $cmd->fetchAll(PDO::FETCH_ASSOC);

        }

        // LISTAR ATIVOS
        public static function listarAtivos(): array {

            $cmd = obterPdo()->query("SELECT * FROM servicos WHERE descontinuado = b'0' ORDER BY nome ASC");
            return $cmd->fetchAll(PDO::FETCH_ASSOC);

        }

        // BUSCAR POR ID
        public function buscarPorId(int $id): bool {
            $sql = "SELECT * FROM servicos WHERE id = :id";
            $cmd = obterPdo()->prepare($sql);
            $cmd->bindValue(":id", $id);
            $cmd->execute();

            if($dados = $cmd->fetch(PDO::FETCH_ASSOC)) {

                $this->id = $dados['id'];
                $this->nome = $dados['nome'];
                $this->descricao = $dados['descricao'];
                $this->preco = $dados['preco'];
                $this->descontinuado = $dados['descontinuado'];
                return true;

            }
            return false;
        }

        // ATUALIZAR
        public function atualizar(): bool {

            $sql = "UPDATE servicos SET nome=:nome, descricao=:descricao, preco=:preco WHERE id=:id";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":nome", $this->nome);
            $cmd->bindValue(":descricao", $this->descricao);
            $cmd->bindValue(":preco", $this->preco);
            $cmd->bindValue(":id", $this->id);
            return $cmd->execute();

        }

        // EXCLUIR
        public function excluir(int $id): bool {
            $cmd = $this->pdo->prepare("UPDATE servicos SET descontinuado = b'1' WHERE id = :id");
            $cmd->bindValue(":id", $id);
            return $cmd->execute();
        }
    }