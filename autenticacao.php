<?php
    session_start();

    if(!empty($_POST)){
        include "conexao.php";
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        $sql = "SELECT id_usuario, permissao, email FROM usuario WHERE email='$email' AND senha='$senha'";

        $resultado = mysqli_query($conexao,$sql)
                                    or die(mysqli_error($conexao));

        if(mysqli_num_rows($resultado) == "1"){
            $linha = mysqli_fetch_assoc($resultado);
            $_SESSION["usuario"] = $linha["id_usuario"];
            $_SESSION["permissao"] = $linha["permissao"];
            $_SESSION["email"] = $linha["email"];
            header("location: index.php");
        }
        else{
            header("location: index.php?erro=1");
        }
    }
?>