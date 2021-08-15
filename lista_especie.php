<?php
include "conf.php";
cabecalho();

if($_SESSION["permissao"]=="2"){
    echo "<script>location.href='index.php'</script>";
}
?>

<div class="col-xs-10 offset-xs-1 col-sm-6 offset-sm-3 col-md-4 offset-md-4 py-4">
    <form method="POST" action="lista_especie.php">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon">
                </div>
                <input type="text" name="nome" placeholder="Nome da Espécie" class="form-control" />
            </div>
        </div>
        <center><button type="submit" class="btn btn-dark">Pesquisar Espécie</button></center>
    </form>
</div>
<div id="msg"></div>
<div class="col-xs-10 offset-xs-1 col-sm-6 offset-sm-3 col-md-4 offset-md-4 py-4">
    <table class="table">
    <thead>
        <tr>
            <th style="text-align:left">ESPÉCIE</th>
            <th>Ação</th>
        </tr>
    </thead>
    <tbody id="tbody_especie">

<?php
    $i=0;
    $select = "SELECT * FROM especie";
    if(!empty($_POST)){
        $select .= " WHERE(1=1)";
        if($_POST["nome"] != ""){
            $nome = $_POST["nome"];
            $select .= " AND nome like '%$nome%'";
        }
    }

    $resultado = mysqli_query($conexao,$select);

    while($linha = mysqli_fetch_assoc($resultado)){
        echo '<tr>
                <td>'.$linha["nome"].'</td>
                <td>
                    <button class="btn btn-warning alterar" value="'.$linha["id_especie"].'" data-toggle="modal" data-target="#modal">Alterar</button>
                    <button class="btn btn-danger remover" value="'.$linha["id_especie"].'">Remover</button>
                </td>
            </tr>';
        $i++;
    }
    if($i==0){
        echo "<tr><td colspan='2'>Não há espécies cadastradas</td></tr>";
    }

        echo "</tbody>";
echo "</table>
<span id='id_especie_oculto'></span>";

$titulo = "Alterar Espécie";
$nome_form = "alterar_especie.php";
include "modal.php";

include "scripts_especie.php";
rodape();

?>