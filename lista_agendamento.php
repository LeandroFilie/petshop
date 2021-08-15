<?php
include "conf.php";
cabecalho();

if(!isset($_SESSION["usuario"])){
    echo "<script>location.href='index.php'</script>";
}

if($_SESSION["permissao"]=="1"){
    echo '
    <div class="col-xs-10 offset-xs-1 col-sm-6 offset-sm-3 col-md-4 offset-md-4 py-4">
    <form method="POST" action="lista_agendamento.php">
        <div class="form-group">    
            <select name="cliente" id="cliente" class="form-control">
                <option value="">::Selecione o dono::</option>';
                    include "conexao.php";
                    $select = "SELECT id_cliente, nome FROM cliente";
                    $resultado = mysqli_query($conexao,$select);
                    while($linha=mysqli_fetch_assoc($resultado)){
                        echo '<option value='.$linha["id_cliente"].'>'.$linha["nome"].'</option>';
                    }
            echo '
            </select>
        </div>
        <div class="form-group">
            <div id="animal">
                <select name="animal" class="form-control" disabled>
                    <option value="">::Selecione o Pet::</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <input type="date" class="form-control" id="data" name="data" />
            </div>
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
            <th>Nome do Dono</th>
            <th>Telefone</th>
            <th>Pet</th>
            <th>Raça</th>
            <th>Dia</th>
            <th>Hora</cliente>
            <th>Ação</cliente>
        </tr>
    </thead>
    <tbody id="tbody_agendamento">

<?php
    $select = "SELECT id_agendamento, cliente.nome as nome_cliente, telefone, animal.nome as nome_animal, raca.nome as nome_raca, dia, hora FROM agendamento INNER JOIN animal ON agendamento.cod_animal = animal.id_animal INNER JOIN cliente ON animal.cod_cliente = cliente.id_cliente INNER JOIN raca ON animal.cod_raca = raca.id_raca";
    
    if($_SESSION["permissao"]=="2"){
        $select .= " WHERE cpf='".$_SESSION["usuario"]."'";
    }

    if(!empty($_POST)){
        if($_POST["cliente"] != ""){
            if(isset($_POST["animal"]) && $_POST["animal"]!=""){
                $animal = $_POST["animal"];
                $select .= " AND agendamento.cod_animal = '$animal'";
            }
            else{
                $cliente = $_POST["cliente"];
                $select .= " AND animal.cod_cliente = '$cliente'";
            }   
        }
        if($_POST["data"]!=""){
            $data = $_POST["data"];
            $select .= " AND dia = '$data'";
        
        }
    }
    
    $resultado = mysqli_query($conexao,$select)
                            or die("Erro: " . mysqli_error($conexao));   
    $i=0;
    while($linha = mysqli_fetch_assoc($resultado)){
        echo '<tr>
                <td>'.$linha["nome_cliente"].'</td>
                <td>'.$linha["telefone"].'</td>
                <td>'.$linha["nome_animal"].'</td>
                <td>'.$linha["nome_raca"].'</td>
                <td>'.date("d/m/Y", strtotime($linha["dia"])).'</td>
                <td>'.$linha["hora"].'</td>
                <td>
                    <button class="btn btn-warning alterar" value="'.$linha["id_agendamento"].'" data-toggle="modal" data-target="#modal">Alterar</button>
                    <button class="btn btn-danger remover" value="'.$linha["id_agendamento"].'">Remover</button>
                </td>
            </tr>'; 
            $i++;
    }
    if($i==0){
        echo "<tr><td colspan='5'>Não há agendamentos cadastrados</td></tr>";
    }
    echo "</tbody>";
echo "</table>
<span id='id_agendamento_oculto'></span>";

echo '
    <script>
    $(function(){
        $("#cliente").change(function(){
            var cliente = $("#cliente").val();
            $.post("select_animal.php",{"cliente":cliente},function(pets){
                texto = "<select name=\"animal\" id=\"cod_animal\" class=\"form-control\"><option value=\"\">::Selecione o Pet::</option>";
                $.each(pets.pet,function(i,v){
                    texto += "<option value=" +v.id_animal+ ">" +v.nome+ "</option>";
                });
                texto += "</select>";
                $("#animal").html(texto);
            });
        });
    });
    </script>
';

$titulo = "Alterar Agendamento";
$nome_form = "alterar_agendamento.php";
include "modal.php";

include "scripts_agendamento.php";
rodape();

?>