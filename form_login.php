<div class="modal fade" id="modal_login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Autentica&ccedil;&atilde;o</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="login" method="post" action="autenticacao.php">
                <div class="modal-body">
                    <div class="input-group">
                        <input type="text" name="email" placeholder="Email..." class="form-control" />
                    </div>
                    <div class="input-group">
                        <input type="password" name="senha" id="senha" placeholder="Senha..." class="form-control" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary col-3" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary autenticar col-8">Autenticar</button>
                </div>
            </form>
            <h6 style="text-align:center">Ainda n&atilde;o &eacute; cadastrado?<a href="#"> Cadastre-se Aqui</a></h6>
        </div>
    </div>
</div>
<script src='js/jquery-3.5.1.min.js'></script>
<script src='js/md5.js'></script>
<script>
    $(function(){
        $(".autenticar").click(function(){
            var senha_md5 = $.md5($("#senha").val());
            $("#senha").val(senha_md5);
            $("form[name='login']").submit();
        });
    });
</script>