<?php

    header('Content-Type: application/json');

    $especie = $_POST["especie"];

    include "conexao.php";

    $select = "SELECT raca.nome, raca.id_raca FROM raca WHERE raca.cod_especie = '$especie'";

    $resultado = mysqli_query($conexao,$select);

    while($linha = mysqli_fetch_assoc($resultado)){
        $raca[] = $linha;
    }
    
    $racas["raca"] = $raca;

    echo json_encode($racas);
?>