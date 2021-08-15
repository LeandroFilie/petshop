<?php
    $host = "us-cdbr-east-04.cleardb.com";
    $db = "heroku_1644ed5833d0dab";
    $user = "b0e2242e45b1e4";
    $senha = "0a423608";

    $conexao = mysqli_connect($host,$user,$senha,$db) 
        or die("Erro ao abrir a conexão com o banco de dados.");

    mysqli_set_charset($conexao, "utf8");
?>