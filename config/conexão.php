<?php
// Habilita a exibição de erros para facilitar o debug durante o desenvolvimento
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function obterPdo():PDO{
    // Configurações de acesso ao banco de dados
    $host = "10.91.47.45";
    $db = "servicehubdb01";
    $user = "root"; 
    $pass = "P@ssw0rd";

    static $pdo;// Mantém a conexão ativa para evitar múltiplas conexões desnecessárias

    try{
        // Cria a instância do PDO (PHP Data Objects) para conexão com MySQL
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8",$user,$pass);
        // Define o modo de erro para lançar exceções, facilitando o tratamento de falhas
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    }

    catch(PDOException $e){
        // Caso a conexão falhe, interrompe o script e exibe a mensagem de erro
        die("Erro na conexão: ".$e->getMessage());

    }

    return $pdo;

}