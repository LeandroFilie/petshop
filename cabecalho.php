<?php

function cabecalho(){
    session_start();
    $alt = $GLOBALS["alt"];
    $menu = $GLOBALS["menu"];
    date_default_timezone_set('America/Sao_Paulo');
    echo "<!DOCTYPE html>
    <html>
        <head>
            <meta charset='utf-8' />
<<<<<<< HEAD
            <link rel=\"icon\" type=\"image/png\" href=\"/./img/logotipo.png\"/>
=======
            <link rel=\"icon\" type=\"image/png\" href=\"/logotipo.png\"/>
>>>>>>> 42036429c2862790d6a74c1e9ff0c9bedbd746a3
            <script src='js/jquery-3.5.1.min.js'></script>
            <script src='js/moment.js'></script>
            <script src='js/md5.js'></script>";
        echo '
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>        
        ';

        echo "
            <link href='css/main.css' rel='stylesheet' />     
            <title>PetShop</title>         
        </head>
        <body>                
            <nav class='navbar navbar-expand-md bg-primary navbar-dark'>
            <a href='index.php' class='navbar-brand logotipo'>
                <img src='img/logotipo.png' class='rounded' alt='$alt' />
            </a>

            <!-- botão que aparece quando a tela for pequena -->
            <button class='navbar-toggler' type='button'
                data-toggle='collapse' data-target='#menu'>
                <span class='navbar-toggler-icon'></span>
            </button>

            <div class='collapse navbar-collapse' id='menu'>
                <ul class='navbar-nav'>";
                    if(isset($_SESSION["usuario"])){   
                        if($_SESSION["permissao"] == 2){
                            echo "<li role='presentation' class='dropdown'>
                                <a class='dropdown-toggle' data-toggle='dropdown' href='#' role='button' aria-haspopup='true' aria-expanded='false'>
                                Cadastrar <span class='caret'></span>
                                </a>
                                <ul class='dropdown-menu'>"; 
                                echo "<li class='nav-item'>
                                        <a class='menu' href='form_animal.php'>Meu Pet</a>
                                    </li>";
                                echo "<li class='nav-item'>
                                    <a class='menu' href='form_Agendamento.php'>Agendar</a>
                                </li>
                                </ul>";
                            echo "<li role='presentation' class='dropdown'>
                                <a class='dropdown-toggle' data-toggle='dropdown' href='#' role='button' aria-haspopup='true' aria-expanded='false'>
                                Listar <span class='caret'></span>
                                </a>
                                <ul class='dropdown-menu'>"; 
                                echo "<li class='nav-item'>
                                    <a class='menu' href='lista_cliente.php'>Meus Dados</a>
                                </li>";
                                echo "<li class='nav-item'>
                                        <a class='menu' href='lista_animal.php'>Meus Pets</a>
                                    </li>";
                                echo "<li class='nav-item'>
                                    <a class='menu' href='lista_agendamento.php'>Meus Agendamentos</a>
                                </li>";                       
                        }
                        else{
                            echo "<li role='presentation' class='dropdown'>
                                <a class='dropdown-toggle' data-toggle='dropdown' href='#' role='button' aria-haspopup='true' aria-expanded='false'>
                                Cadastrar <span class='caret'></span>
                                </a>
                                <ul class='dropdown-menu'>";                        
                            foreach($menu as $i=>$l){
                                echo "<li class='nav-item'>
                                        <a class='menu' href='form_$i.php'>$l</a>
                                    </li>";
                            }  
                            echo "</ul>
                            </li>
                            <li role='presentation' class='dropdown'>
                            <a class='dropdown-toggle' data-toggle='dropdown' href='#' role='button' aria-haspopup='true' aria-expanded='false'>
                            Listar <span class='caret'></span>
                            </a>
                            <ul class='dropdown-menu'>";                        
                            foreach($menu as $i=>$l){
                                echo "<li class='nav-item'>
                                        <a class='menu' href='lista_$i.php'>$l</a>
                                    </li>";
                            }
                        }
                          
                        echo "
                                </ul>
                            </li>
                            <li role='presentation'>
                                <a href='logout.php'>Sair</a>
                            </li>
                            ";
                    }
                    else{
                        echo "
                        <li role='presentation'>
                            <a href='form_cliente.php'>Cadastrar-se</a>
                        </li>
                        
                        <li role='presentation'>
                            <a href='#' data-toggle='modal' data-target='#modal_login'>Login</a>
                        </li>
                        ";
                    }
                    

            echo "</ul>  
                    
            </div>        
        </nav>
        <main role='main' class='container'>";
        if(isset($_GET["erro"])){
            echo "<div id='erro' class='alert alert-danger'>Erro na Autentica&ccedil;&atilde;o. Tente Novamente</div>";
        }
}

include "form_login.php";
?>