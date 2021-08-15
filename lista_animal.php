<?php
include "conf.php";
cabecalho();

if(!isset($_SESSION["usuario"])){
    echo "<script>location.href='index.php'</script>";
}


if($_SESSION["permissao"]=="1"){
    echo '
    <div class="col-xs-10 offset-xs-1 col-sm-6 offset-sm-3 col-md-4 offset-md-4 py-4">
    <form method="POST" action="lista_animal.php">
        <div class="form-group">
            <select name="especie" id="especie" class="form-control">
                <option value="">::Selecione uma Espécie::</option>';
                $select = "SELECT id_especie, nome FROM especie";
                $resultado = mysqli_query($conexao,$select);

                while($linha=mysqli_fetch_assoc($resultado)){
                    echo '<option value='.$linha["id_especie"].'>'.$linha["nome"].'</option>';
                }
            echo '
            </select>
        </div>
        <div class="form-group">
            <div id="raca">
                <select name="raca" class="form-control" disabled>
                    <option value="">::Selecione a Raça::</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <input type="text" name="nome" placeholder="Nome do Animal" class="form-control" />
            </div>
        </div>
        <div class="form-group">    
            <select name="cliente" id="cliente" class="form-control">
                <option value="">::Selecione o dono do animal::</option>';
                        include "conexao.php";
                        $select = "SELECT id_cliente, nome FROM cliente";
                        $resultado = mysqli_query($conexao,$select);
                        while($linha=mysqli_fetch_assoc($resultado)){
                            echo '<option value='.$linha["id_cliente"].'>'.$linha["nome"].'</option>';
                        }
            echo '
            </select>
        </div>
        <center><button type="submit" class="btn btn-dark">Pesquisar Animal</button></center>
    </form>
</div>
    ';
}
?>

<div id="msg"></div>
<table class="table">
    <thead>
        <tr style="text-align:left">
            <th>Nome da Animal</th>
            <th>Espécie</th>
            <th>Raça</th>
            <th>Nome do Dono</cliente>
            <th>Ação</th>
        </tr>
    </thead>
    <tbody id="tbody_animal">

<?php
    $select = "SELECT id_animal, animal.nome as nome_animal, especie.nome as nome_especie, raca.nome as nome_raca, cliente.nome as nome_cliente FROM animal INNER JOIN raca ON animal.cod_raca = raca.id_raca INNER JOIN especie ON raca.cod_especie = especie.id_especie INNER JOIN cliente ON animal.cod_cliente = cliente.id_cliente";

    if($_SESSION["permissao"]=="2"){
        $select .= " WHERE cpf='".$_SESSION["usuario"]."'";
    }

    if(!empty($_POST)){
        if($_POST["especie"] != ""){
            if(isset($_POST["raca"]) && $_POST["raca"]!=""){
                $raca = $_POST["raca"];
                $select .= " AND animal.cod_raca = '$raca'";
            }
            else{
                $especie = $_POST["especie"];
                $select .= " AND raca.cod_especie = '$especie'";
            }   
        }
        if($_POST["nome"]!=""){
            $nome = $_POST["nome"];
            $select .= " AND animal.nome LIKE '%$nome%'";
        
        }
        if($_POST["cliente"]!=""){
            $cliente = $_POST["cliente"];
            $select .= " AND animal.cod_cliente = '$cliente'";
        }
    }
    
    $resultado = mysqli_query($conexao,$select)
                            or die("Erro: " . mysqli_error($conexao));   
    $i=0;
    while($linha = mysqli_fetch_assoc($resultado)){
        echo '<tr>
                <td>'.$linha["nome_animal"].'</td>
                <td>'.$linha["nome_especie"].'</td>
                <td>'.$linha["nome_raca"].'</td>
                <td>'.$linha["nome_cliente"].'</td>
                <td>
                    <button class="btn btn-warning alterar" value="'.$linha["id_animal"].'" data-toggle="modal" data-target="#modal">Alterar</button>
                    <button class="btn btn-danger remover" value="'.$linha["id_animal"].'">Remover</button>
                </td>
            </tr>'; 
            $i++;
    }
    if($i==0){
        echo "<tr><td colspan='5'>Não há pets cadastrados</td></tr>";
    }
    echo "</tbody>";
echo "</table>
<span id='id_animal_oculto'></span>";

echo '
<script>
$(document).ready(function(){
    $("#especie").change(function(){
        var especie = $("#especie").val();
        $.post("select_raca.php",{"especie":especie},function(racas){
            texto = "<select name=\"raca\" id=\"cod_raca\" class=\"form-control\"><option value=\"\">::Selecione a Raça::</option>";
            $.each(racas.raca,function(i,v){
                texto += "<option value=" +v.id_raca+ ">" +v.nome+ "</option>";
            });
            texto += "</select>";
            $("#raca").html(texto);
        });
    });
});
</script>';

$titulo = "Alterar Animal";
$nome_form = "alterar_animal.php";
include "modal.php";

include "scripts_animal.php";
rodape();

?>