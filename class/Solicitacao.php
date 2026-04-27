<?php 

    // incluir a conexão
    include_once "config/conexao.php";

    // declara a classe
    class Solicitacao {

        // atributos
        private $id;
        private $cliente_id;
        private $descricao_problema;
        private $data_preferida;
        private $status;
        private $data_cad;
        private $data_atualizacao;
        private $data_resposta;
        private $resposta_admin;
        private $endereco;
        private $pdo;

        // Construtor
        public function __construct(){

            $this->pdo = obterPdo();

        }

        //Getters / Setters
        public function getId(){

            return $this->id;

        }

        // Cliente_id
        public function getCliente_id() { 
            
            return $this->cliente_id; 
        
        }
        public function setCliente_id($cliente_id) { 
        
            $this->cliente_id = $cliente_id; 
        
        }

        // Descricao_problema
        public function getDescricao_problema() { 
            
            return $this->descricao_problema; 
        
        }
        public function setDescricao_problema($descricao_problema) { 
        
            $this->descricao_problema = $descricao_problema; 
        
        }

        // Data_preferida
        public function getData_preferida() { 
            
            return $this->data_preferida; 
        
        }
        public function setData_preferida($data_preferida) { 
        
            $this->data_preferida = $data_preferida; 
        
        }

        // Status
        public function getStatus() { 
            
            return $this->status; 
        
        }
        public function setStatus($status) { 
        
            $this->status = $status; 
        
        }

        // Data_cadastro
        public function getData_cad() { 
            
            return $this->data_cad; 
        
        }
        public function setData_cad($data_cad) { 
        
            $this->data_cad = $data_cad; 
        
        }

        // Data_atualizacao
        public function getData_atualizacao() { 
            
            return $this->data_atualizacao; 
        
        }
        public function setData_atualizacao($data_atualizacao) { 
        
            $this->data_atualizacao = $data_atualizacao; 
        
        }

        // Data_resposta
        public function getData_resposta() { 
            
            return $this->data_resposta; 
        
        }
        public function setData_resposta($data_resposta) { 
        
            $this->data_resposta = $data_resposta; 
        
        }

        // Resposta_admin
        public function getResposta_admin() { 
            
            return $this->resposta_admin; 
        
        }
        public function setResposta_admin($resposta_admin) { 
        
            $this->resposta_admin = $resposta_admin; 
        
        }




    }



?>