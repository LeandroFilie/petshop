<?php
include "conf.php";

cabecalho();
?>
<div class="col-xs-10 offset-xs-1 col-sm-6 offset-sm-3 col-md-6 py-4">
    <div id="form">
        <div class="container">
            <center><span class="h3">Cadastrar Espécie</span></center>
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome da Espécie">
                    </div>
                </div>
            <center><button type="submit" id="enviar" class="btn btn-dark">Cadastrar</button></center>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#enviar").click(function(){
            var nome = $("#nome").val();
            $.post("insere.php",{"nome":nome,"identifica":1},function(msg){
                $("#form").html("<h3>"+msg+"</h3>");
            });
        });
    });
</script>

<?php
rodape();

?>