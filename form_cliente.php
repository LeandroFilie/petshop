<?php
include "conf.php";

cabecalho();
?>
<div class="col-xs-10 offset-xs-1 col-sm-6 offset-sm-3 col-md-6 py-4" id="form">
    <div class="container">
        <center><span class="h3">Cadastrar Cliente</span></center>
            <div class="form-group">
                <div class="input-group">
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Cliente" required>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" required>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <input type="text" class="form-control" id="tel" name="tel" placeholder="Telefone" required>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
                </div>
            </div>
            <?php
                if(!isset($_SESSION["permissao"])){
            ?>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="password" class="form-control" id="senha_cadastro" name="senha_cadastro" placeholder="Senha" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="password" class="form-control" id="senha_confirma" name="senha_confirma" placeholder="Confirme sua Senha" required>
                        </div>
                    </div>
                    <div id="confirmacao"></div>
                
                <?php
                }else{?>
                    <input type="hidden" name="senha_cadastro" id="senha_cadastro" value="12345" />
                    <input type="hidden" name="senha_confirma" id="senha_confirma" value="12345" />
                <?php
                }
                ?>
            
        <center><button type="submit" id="enviar" class="btn btn-dark">Cadastrar</button></center>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#enviar").click(function(){
            var nome = $("#nome").val();
            var cpf = $("#cpf").val();
            var tel = $("#tel").val();
            var email = $("#email").val();
            var senha = $("#senha_cadastro").val();
            var confirma_senha = $("#senha_confirma").val();
            if(senha === confirma_senha){
                var senha = $.md5(senha);
                $.post("insere.php",{"nome":nome,"identifica":3,"cpf":cpf,"tel":tel,"email":email,"senha":senha},function(msg){
                    $("#form").html("<h3>"+msg+"</h3>");
                });
            }
            else{
                $("#confirmacao").addClass("alert alert-danger");
                $("#confirmacao").html("As senhas não conferem");
            }
            
        });
    });
</script>

<?php
rodape();

?>