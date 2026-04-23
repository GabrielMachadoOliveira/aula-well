<?php
// ... topo do arquivo igual ...

try {
    $host = 'localhost';
    $db   = 'servicehub';
    
    // TENTATIVA 1: Root sem senha
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", "root", "");
    } catch (Exception $e1) {
        // TENTATIVA 2: Root com senha 'root' (Comum em VMs Linux)
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", "root", "root");
        } catch (Exception $e2) {
            // TENTATIVA 3: Usuário 'admin' com senha 'admin'
            $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", "admin", "admin");
        }
    }
    
    echo "Conexão estabelecida!<br>";

} catch (Exception $e) {
    die("Não foi possível conectar com nenhuma senha padrão: " . $e->getMessage());
}

// 3. A CLASSE CLIENTE (Tudo dentro do mesmo arquivo)
class Cliente {
    private $pdo;
    private $usuario_id;
    private $telefone;
    private $cpf;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function setUsuarioId($id) { $this->usuario_id = $id; }
    public function setTelefone($t) { $this->telefone = $t; }
    public function setCpf($c) { $this->cpf = $c; }

    public function inserir(): bool {
        $sql = "INSERT INTO clientes (usuario_id, telefone, cpf) VALUES (:u, :t, :c)";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":u", $this->usuario_id);
        $cmd->bindValue(":t", $this->telefone);
        $cmd->bindValue(":c", $this->cpf);
        return $cmd->execute();
    }
}

// 4. EXECUTANDO O TESTE
$cliente = new Cliente($pdo);
$cliente->setUsuarioId(1); // Garanta que o usuario ID 1 existe na tabela usuarios
$cliente->setTelefone("11999998888");
$cliente->setCpf("12345678900");

if ($cliente->inserir()) {
    echo "<h2 style='color:green'>SUCESSO ABSOLUTO: Gravado no Banco!</h2>";
} else {
    echo "<h2 style='color:red'>Falha na gravação (verifique se o usuario_id 1 existe).</h2>";
}