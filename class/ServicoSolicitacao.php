<?php
    // incluir a conexão
    include_once "config/conexao.php";

class ServicoSolicitacao {
    private $servico_id;
    private $solicitacao_id;
    private $data_assoc;
    private $pdo;

    public function __construct(){

        $this->pdo = obterPdo();

    }

    // Métodos Obrigatórios
    public function getServico_id(){

        return $this->servico_id;
        
    }
    public function setServico_id(int $servico_id){

        $this->servico_id = $servico_id;

    }

    public function getSolicitacao_id(){

        return $this->solicitacao_id;

    }
        public function setSolicitacao_id(int $solicitacao_id){

        $this->solicitacao_id = $solicitacao_id;

    }

    public function getData_assoc(){

        return $this->data_assoc;

    }
        public function setData_assoc(int $data_assoc){

        $this->data_assoc = $data_assoc;

    }

    public static function associar(int $servico_id, int $solicitacao_id): bool{
        $sql = "insert servico_solicitacao values(:servico_id, :solicitacao_id, default)";
        $cmd = obterPdo()->prepare($sql);
        $cmd->bindValue(":servico_id", $servico_id);
        $cmd->bindValue(":solicitacao_id", $solicitacao_id);
        return $cmd->execute();
    }
    //ServicoSolicitacao::associar(1,4);
    public function listarServicosDaSolicitacao(int $solicitacao_id): array{

        $sql = "SELECT se.*, ss.data_assoc
                FROM servico_solicitacao ss
                INNER JOIN servicos se ON se.id = ss.servico_id
                WHERE ss.solicitacao_id = :solicitacao_id";
        $cmd = obterPdo()->prepare($sql);
        $cmd->bindValue(":solicitacao_id", $solicitacao_id, PDO::PARAM_INT);
        $cmd->execute();
        return $cmd->fetchALL(PDO::FETCH_ASSOC);

    }


}
