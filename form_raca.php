<?php
include "conf.php";

cabecalho();
?>
<div class="col-xs-10 offset-xs-1 col-sm-6 offset-sm-3 col-md-6 py-4" id="form">
    <div class="container">
        <center><span class="h3">Cadastrar Raça</span></center>
            <div class="form-group">
                <div class="input-group">
                    <input type="text" name="nome" id="nome" placeholder="Nome da Raça" class="form-control" required= "required"/>
                </div>
            </div>
            <div class="form-group">    
                <select name="especie" id="especie" class="form-control" required>
                    <option value="">::Selecione a Espécie::</option>
                        <?php
                            include "conexao.php";
                            $select = "SELECT id_especie, nome FROM especie";
                            $resultado = mysqli_query($conexao,$select);
                            while($linha=mysqli_fetch_assoc($resultado)){
                                echo '<option value='.$linha["id_especie"].'>'.$linha["nome"].'</option>';
                            }
                        ?> 
                </select>
            </div>
        <center><button type="submit" id="enviar" class="btn btn-dark">Cadastrar</button></center>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#enviar").click(function(){
            var nome = $("#nome").val();
            var especie = $("#especie").val();
            $.post("insere.php",{"nome":nome,"identifica":2,"especie":especie},function(msg){
                $("#form").html("<h3>"+msg+"</h3>");
            });
        });
    });
</script>

<?php
rodape();

?>