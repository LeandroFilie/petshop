<?php

    header('Content-Type: application/json');

    $cliente = $_POST["cliente"];

    include "conexao.php";

    $select = "SELECT nome, id_animal FROM animal WHERE cod_cliente= '$cliente'";

    $resultado = mysqli_query($conexao,$select);

    while($linha = mysqli_fetch_assoc($resultado)){
        $pet[] = $linha;
    }
    
    $pets["pet"] = $pet;

    echo json_encode($pets);
?>