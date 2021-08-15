<?php
include "conf.php";

cabecalho();
?>
<div class="col-xs-10 offset-xs-1 col-sm-6 offset-sm-3 col-md-6 py-4">
    <div id="form">
        <div class="container">
            <center><span class="h3">Agendar Banho e Tosa</span></center>
            <div class="form-group"> 
                <?php
                    include "conexao.php";
                    $select = "SELECT id_cliente, nome FROM cliente";
                    if($_SESSION["permissao"] == 2){
                        echo '<select name="cliente" id="cliente" class="form-control" required disabled>';
                        $select .= " WHERE cpf='".$_SESSION["usuario"]."'";
                    }
                    else{
                        echo '<select name="cliente" id="cliente" class="form-control" required>';
                        echo '<option value="">::Selecione o dono::</option>';
                    }
                
                    $resultado = mysqli_query($conexao,$select);
                    while($linha=mysqli_fetch_assoc($resultado)){
                        echo '<option value='.$linha["id_cliente"].'>'.$linha["nome"].'</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <div id="animal">                        
                    <?php
                        if($_SESSION["permissao"] == 2){
                            echo '<select name="animal" id="cod_animal" class="form-control" required>
                            <option value="">::Selecione o Pet::</option>';
                            include "conexao.php";
                            $select = 'SELECT id_animal, animal.nome as nome_animal FROM animal INNER JOIN cliente ON animal.cod_cliente = cliente.id_cliente WHERE cliente.cpf = '.$_SESSION["usuario"].'';
                            $resultado = mysqli_query($conexao,$select);
                            while($linha=mysqli_fetch_assoc($resultado)){
                                echo '<option value='.$linha["id_animal"].'>'.$linha["nome_animal"].'</option>';
                            }
                        }
                        else{
                            echo '<select name="animal" class="form-control" required disabled>
                            <option value="">::Selecione o Pet::</option>';
                        }
                    ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <input type="date" class="form-control" id="data" name="data" required/>
                    <span id="hora">
                        <select name="horario" class="form-control" disabled>
                            <option value="">::Selecione o Horário::</option>
                        </select>
                    </span>
                </div>
            </div>
            <center><button type="submit" id="enviar" class="btn btn-dark">Agendar</button></center>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#cliente").change(function(){
            var cliente = $("#cliente").val();
            $.post("select_animal.php",{"cliente":cliente},function(pets){
                texto = "<select name=\"animal\" id=\"cod_animal\" class=\"form-control\" required><option value=\"\">::Selecione o Pet::</option>";
                $.each(pets.pet,function(i,v){
                    texto += "<option value=" +v.id_animal+ ">" +v.nome+ "</option>";
                });
                texto += "</select>";
                $("#animal").html(texto);
            });
        });
        $("#data").blur(function(){
            var data = $("#data").val();

            $.post("select_hora.php",{"data":data},function(horarios){
                tamanho = horarios.length;
                texto = "<select name=\"horario\" id=\"horario\" class=\"form-control\" required><option value=\"\">::Selecione o Horário::</option>";
                for(var i=0; i<tamanho; i++){
                    texto += "<option value=" +horarios[i]+ ">" +horarios[i]+ "</option>";
                }
                texto += "</select>";
                $("#hora").html(texto);
            });
            
        });
        $("#enviar").click(function(){
            var animal = $("#cod_animal").val();
            var data = $("#data").val();
            var horario = $("#horario").val();
            $.post("insere.php",{"animal":animal,"data":data,"hora":horario,"identifica":5},function(msg){
                $("#form").html("<h3>"+msg+"</h3>");
            });
        });
    });
</script>

<?php
rodape();

?>