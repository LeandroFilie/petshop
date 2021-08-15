<?php

include "conexao.php";
session_start();

if($_POST["cod"] == 1){
    $nome = $_POST["nome"];
    $id_especie = $_POST["id_especie"];

    $update = "UPDATE especie SET nome='$nome'
                                WHERE
                                id_especie='$id_especie'";
    
    mysqli_query($conexao,$update)
        or die("Erro: " . mysqli_error($conexao));

    echo "1";
}
else if($_POST["cod"] == 2){
    $nome = $_POST["nome"];
    $cod_especie = $_POST["cod_especie"];
    $id_raca = $_POST["id_raca"];

    $update = "UPDATE raca SET nome='$nome',
                                cod_especie='$cod_especie'
                                WHERE
                                id_raca='$id_raca'";
    
    mysqli_query($conexao,$update)
        or die("Erro: " . mysqli_error($conexao));

    echo "1";
}
else if($_POST["cod"] == 3){
    $nome = $_POST["nome"];
    $id_cliente = $_POST["id_cliente"];
    $cpf = $_POST["cpf"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];
    $senha_cadastro = $_POST["senha_cadastro"];

    $update = "UPDATE cliente SET nome='$nome',
                                cpf = '$cpf',
                                telefone = '$telefone',
                                email = '$email'
                                WHERE
                                id_cliente='$id_cliente'";
    
    mysqli_query($conexao,$update)
        or die("Erro: " . mysqli_error($conexao));

    $select = "SELECT cpf FROM cliente WHERE id_cliente = $id_cliente";

    $resultado = mysqli_query($conexao,$select);

    if(mysqli_num_rows($resultado) == "1"){
        $linha = mysqli_fetch_assoc($resultado);
        $cpf_cliente = $linha["cpf"];
    }

    $update = "UPDATE usuario SET email='$email' ";

    if($senha_cadastro!=""){
        $update .= " , senha='$senha_cadastro'";
    }
    $update .=" WHERE
                    id_usuario='$cpf_cliente'";
                    
        mysqli_query($conexao,$update)
            or die(mysqli_error($conexao));

    if($_SESSION["permissao"] == 2){
        echo "2";
    }
    else{
        echo "1";
    }

    
}

else if($_POST["cod"] == 4){
    $nome = $_POST["nome"];
    $cliente = $_POST["cliente"];
    $raca = $_POST["raca"];
    $id_animal = $_POST["id_animal"];

    $update = "UPDATE animal SET nome='$nome',
                                cod_cliente='$cliente',
                                cod_raca='$raca'
                                WHERE
                                id_animal='$id_animal'";

    mysqli_query($conexao,$update)
        or die(mysqli_error($conexao));

    if($_SESSION["permissao"] == 2){
        echo "2";
    }
    else{
        echo "1";
    }
}   
else if($_POST["cod"] == 5){
    $animal = $_POST["animal"];
    $data = $_POST["data"];
    $hora = $_POST["hora"];
    $id_agendamento = $_POST["id_agendamento"];

    $update = "UPDATE agendamento SET cod_animal='$animal',
                                dia='$data',
                                hora='$hora'
                                WHERE
                                id_agendamento='$id_agendamento'";

    mysqli_query($conexao,$update)
        or die(mysqli_error($conexao));

    if($_SESSION["permissao"] == 2){
        echo "2";
    }
    else{
        echo "1";
    }
}   


?>