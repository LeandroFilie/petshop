<form>
<div>    
    <?php
        include "conexao.php";
        $select = "SELECT id_cliente, nome FROM cliente";
        if($_SESSION["permissao"] == 2){
            echo '<select name="cliente_modal" id="cliente_modal" class="form-control" required disabled>';
            $select .= " WHERE cpf='".$_SESSION["usuario"]."'";
        }
        else{
            echo '<select name="cliente_modal" id="cliente_modal" class="form-control" required>';
            echo '<option value="">::Selecione o dono::</option>';
        }
        $resultado = mysqli_query($conexao,$select);
        while($linha=mysqli_fetch_assoc($resultado)){
            echo '<option value='.$linha["id_cliente"].'>'.$linha["nome"].'</option>';
        }
        echo "</select>";
    ?>
    
</div>
<div>
    <div id="animal">
        <select name="animal_modal" id="animal_modal" class="form-control" required>
            <option value="">::Selecione o Pet::</option>
        </select>
    </div>
</div>
<div>
    <div class="input-group">
        <input type="date" class="form-control" id="data_modal" name="data_modal" required/>
        <span id="hora">
            <select name="horario_modal" id="horario_modal" class="form-control">
                <option value="">::Selecione o Horário::</option>
            </select>
        </span>
    </div>
</div>
</form>
        