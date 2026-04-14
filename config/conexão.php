<?php

$host = "10.91.47.45";
// $host = "10.91.47.46";
$db = "servicehubdb01"; // nome do banco de dados
$user = "root"; 
$pass = "P@ssw0rd";
 // php.net
try{
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8",$user,$pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    // echo "conectado com sucesso!<br>";
    // var_dump($pdo);
}catch(PDOException $e){
    // var_dump($e->getMessage());
    die("Erro na conexão: ".$e->getMessage());
}