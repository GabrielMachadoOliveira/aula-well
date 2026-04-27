<?php 

    // incluir a conexão
    include_once "config/conexao.php";

    // declara a classe
    class Cliente {
    
        // atributos
        private $id;
        private $usuario_id;
        private $telefone;
        private $cpf;
        private $tipo;
        private $ativo;
        private $pdo;

        // construtor
        public function __construct(){

            $this->pdo = obterPdo();

        }

        //Getters / Setters
        public function getId(){

            return $this->id;

        }

        //usuario_id
        public function getUsuario_id(){

            return $this->usuario_id;

        }
        public function setUsuario_id(string $usuario_id){

            $this->usuario_id = $usuario_id;

        }

        //telefone
        public function getTelefone(){

            return $this->telefone;

        }
        public function setTelefone(string $telefone){

            $this->telefone = $telefone;

        }

        //cpf
        public function getCpf(){

            return $this->cpf;

        }
        public function setCpf(string $cpf){

            $this->cpf = $cpf;

        }

        //TIPO
        public function getTipo(){

            return $this->tipo;

        }
        public function setTipo(string $tipo){

            $this->tipo = $tipo;

        }

        //ATIVO
        public function getAtivo(){

            return $this->ativo;

        }
        public function setAtivo(string $ativo){

            $this->ativo = $ativo;

        }


        // metodos (functions) - Representam os RFs do projeto

        // inserir
        public function inserir():bool{
            $sql = "INSERT clientes (usuario_id, telefone, cpf, tipo)
             values (:usuario_id, :telefone, :cpf, :tipo)";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":usuario_id", $this->usuario_id);
            $cmd->bindValue(":telefone", $this->telefone);
            $cmd->bindValue(":cpf", $this->cpf);
            $cmd->bindValue(":tipo", $this->tipo);

            if($cmd->execute()){
    
                $this->id = $this->pdo->lastInsertId();
                return true;

            }
            return true;
        }
        // Listar
        public static function listar():array{

            $cmd = obterPdo()->query("SELEC * FROM clienets ORDER BY id DESC");
            return $cmd->fetchAll(PDO::FETCH_ASSOC);

        }

        // buscar por id
        public function buscarPorId(int $id):bool{
            $sql = "SELECT * FROM clientes WHERE id = :id";
            $cmd = obterPdo()->prepare($sql);
            $cmd->bindValue(":id",$id);
            $cmd->execute();
            if($cmd->rowCount() > 0){

                $dados = $cmd->fetch(PDO::FETCH_ASSOC);
                // var_dump($dados);
                // die();
                $this->id = $dados['id'];
                $this->setUsuario_id($dados['usuario_id']);
                $this->setTelefone($dados['telefone']);
                $this->setCpf($dados['cpf']);
                $this->setTipo($dados['tipo']);
                $this->setAtivo($dados['ativo']);
                return true;

            }
                return false;
            }

        // Atualizar
        public function atualizar():bool{
            if(!$this->id) return false;
            // var_dump($this->id);
            // die();
            $sql = "UPDATE usuarios
                set nome = :nome, email = :email, tipo = :tipo, ativo = :ativo,
                primeiro_login = :primeiro_login
                WHERE id = :id";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":id", $this->id); 
            $cmd->bindValue(":usuario_id", $this->usuario_id);   
            $cmd->bindValue(":telefone", $this->telefone);
            $cmd->bindValue(":cpf", $this->cpf);   
            $cmd->bindValue(":tipo", $this->tipo);   
            $cmd->bindValue(":ativo", $this->ativo, PDO::PARAM_BOOL); 
            return $cmd->execute();
            }

        // BUSCAR POR USUARIO
        public function buscarPorUsuario(int $usuario_id): bool{
            $sql = "SELECT * FROM clientes WHERE usuario_id = :usuario_id LIMIT 1";
            $cmd = obterPdo()->prepare($sql);
            $cmd->bindValue(":usuario_id", $usuario_id, PDO::PARAM_INT);
            $cmd->execute();

            if ($cmd->rowCount() > 0){
                $dados = $cmd->fetch(PDO::FETCH_ASSOC);
                $this->id = $dados["id"];
                $this->usuario_id = $dados["usuario_id"];
                $this->telefone = $dados["telefone"];
                $this->cpf = $dados["cpf"];
                return true;
            }
            return false;
        }
    }
    