<?php

    header('Content-Type: application/json');

    $data = $_POST["data"];
    if(isset($_POST["cod_animal"])){
        $cod_animal = $_POST["cod_animal"];
    }
    
    include "conexao.php";

    $select = "SELECT * FROM agendamento WHERE dia = '$data'";

    $array_h = array("09:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00");

    $resultado = mysqli_query($conexao,$select);

    while($linha = mysqli_fetch_assoc($resultado)){
        $hora=$linha["hora"];
        $id_animal = $linha["cod_animal"];
        $achar_posicao = array_search("$hora", $array_h);
        if(isset($_POST["cod_animal"])){
            if($cod_animal != $id_animal){
                array_splice($array_h, $achar_posicao , 1);
            }
            
        }
        else{
            array_splice($array_h, $achar_posicao , 1);
        }
        
    }

    $horarios = $array_h;

    echo json_encode($horarios);
?>