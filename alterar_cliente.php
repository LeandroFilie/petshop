<form>
    <div class="form-group">
        <div class="input-group">
            <input type="text" class="form-control" id="nome_modal" name="nome_modal" placeholder="Nome do Cliente">
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <input type="text" class="form-control" id="cpf_modal" name="cpf_modal" placeholder="CPF">
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <input type="text" class="form-control" id="tel_modal" name="tel_modal" placeholder="Telefone">
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <input type="text" class="form-control" id="email_modal" name="email_modal" placeholder="Email">
        </div>
    </div>
    <div class="form-group">
        <input type="checkbox" name="trocar_senha" value="1" /> Trocar Senha <br />
        <div id="trocar_senha" style="display:none;" class="input-group">      
            <input type="password" name="senha_cadastro" placeholder="Senha" class="input-control col-6" /> 
            <input type="password" name="senha_confirma" placeholder="Confirme sua senha" class="input-control col-6" /> 
        </div>
    </div>
    <div id="confirmacao_modal"></div>
</form>