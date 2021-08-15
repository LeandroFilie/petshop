<?php

header('Content-Type: application/json');

include "conexao.php";

if($_GET["cod"] == 1){
    $select = "SELECT * FROM especie";

    if(isset($_GET["id"])){
        $id_especie = $_GET["id"];
        $select .= " WHERE id_especie='$id_especie'";
    }

    $select .= " ORDER BY nome";

    $resultado = mysqli_query($conexao,$select)
        or die(mysqli_error($conexao));

    while($linha = mysqli_fetch_assoc($resultado)){
        $matriz[]=$linha;
    }

    echo json_encode($matriz);
}
else if($_GET["cod"] == 2){
    $select = "SELECT id_raca, raca.nome as nome_raca, especie.nome as nome_especie, raca.cod_especie as cod_especie FROM raca INNER JOIN especie ON raca.cod_especie = especie.id_especie";

    if(isset($_GET["id"])){
        $id_raca = $_GET["id"];
        $select .= " WHERE id_raca='$id_raca'";
    }

    $select .= " ORDER BY nome_raca";

    $resultado = mysqli_query($conexao,$select)
        or die(mysqli_error($conexao));

    while($linha = mysqli_fetch_assoc($resultado)){
        $matriz[]=$linha;
    }

    echo json_encode($matriz);
}
else if($_GET["cod"] == 3){
    $select = "SELECT * FROM cliente";

    if(isset($_GET["id"])){
        $id_cliente= $_GET["id"];
        $select .= " WHERE id_cliente='$id_cliente'";
    }

    $select .= " ORDER BY nome";

    $resultado = mysqli_query($conexao,$select)
        or die(mysqli_error($conexao));

    while($linha = mysqli_fetch_assoc($resultado)){
        $matriz[]=$linha;
    }

    echo json_encode($matriz);
}
else if($_GET["cod"] == 4){
    $select = "SELECT id_animal,  animal.nome as nome_animal, especie.nome as nome_especie, raca.nome as nome_raca, cliente.nome as nome_cliente, animal.cod_cliente as cod_cliente, raca.cod_especie as cod_especie, animal.cod_raca as cod_raca FROM animal INNER JOIN raca ON animal.cod_raca = raca.id_raca INNER JOIN especie ON raca.cod_especie = especie.id_especie INNER JOIN cliente ON animal.cod_cliente = cliente.id_cliente";

    if(isset($_GET["id"])){
        $id_animal = $_GET["id"];
        $select .= " WHERE id_animal='$id_animal'";
    }

    $select .= " ORDER BY nome_animal";

    $resultado = mysqli_query($conexao,$select)
        or die(mysqli_error($conexao));

    while($linha = mysqli_fetch_assoc($resultado)){
        $matriz[]=$linha;
    }

    echo json_encode($matriz);
}
else if($_GET["cod"] == 5){
    $select = "SELECT id_agendamento, cod_cliente, cod_animal, cliente.nome as nome_cliente, telefone, animal.nome as nome_animal, raca.nome as nome_raca, dia, hora FROM agendamento INNER JOIN animal ON agendamento.cod_animal = animal.id_animal INNER JOIN cliente ON animal.cod_cliente = cliente.id_cliente INNER JOIN raca ON animal.cod_raca = raca.id_raca";

    if(isset($_GET["id"])){
        $id_agendamento = $_GET["id"];
        $select .= " WHERE id_agendamento='$id_agendamento'";
    }

    $resultado = mysqli_query($conexao,$select)
        or die(mysqli_error($conexao));

    while($linha = mysqli_fetch_assoc($resultado)){
        $matriz[]=$linha;
    }

    echo json_encode($matriz);
}
?>