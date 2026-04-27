<?php

    // incluir a conexão
    include_once "config/cliente.php";

    $cliente = new Cliente();
    $cliente->buscarPorId(2);

    



