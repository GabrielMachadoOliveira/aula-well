<?php 

include_once "config/conexao.php";

if($_SERVER['REQUEST_METHOD']=="POST"){
    //echo "Chamado pela ação do formulario
    $id = $_POST['txtid'];
    $sql = "select id, nome from servicos";
    $cmd = $pdo->prepare($sql);
    $cmd->execute([':id'=>$id]);
    $serv = $cmd->fetchALL(PDO::FETCH_ASSOC);
    var_dump($serv);
}

if($_SERVER['REQUEST_METHOD']=="GET"){

    echo "<h3>Chamado pela URL ou formulário method='get'</h3>";
    $idViaget = $_GET('txtid');
    $sql = "select nome from servicos where id = :id";
    $cmd = $pdo->prepare($sql);
    $cmd->execute([":id"=>$id]);
    $serviços = $cmd->fetchALL(PDO::FETCH_ASSOC);
    var_dump($serviços);

}


// var_dump($_SERVER['REQUEST_METHOD']);


// $id = $_POST['txtid'];
// $sql = "select nome from servicos where id = :id";
// $cmd = $pdo->prepare($sql);
// $cmd->execute([":id"=>$id]);
// $serv = $cmd->fetchALL(PDO::FETCH_ASSOC);

 ?>
