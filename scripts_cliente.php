<script>
    $(function(){
        function define_alterar_remover(){ 
            $(".alterar").click(function(){
                i = $(this).val();
                $("#id_cliente_oculto").val(i);
                $.get("seleciona.php?cod=3&id="+i,function(r){
                    c = r[0];
                    $("#nome_modal").val(c.nome);
                    $("#cpf_modal").val(c.cpf);
                    $("#tel_modal").val(c.telefone);
                    $("#email_modal").val(c.email);
                });
            });

            $(".remover").click(function(){
                i = $(this).val();
                c = "id_cliente";
                t = "cliente";
                p = {tabela:t,id:i,coluna:c}
                $.post("remover.php",p,function(r){
                        $("#msg").removeClass("alert alert-danger");
                        $("#msg").removeClass("alert alert-info");
                        if(r=='1'){    
                            $("#msg").addClass("alert alert-info");            
                            $("#msg").html("Cliente removido com sucesso.");
                            $("button[value='"+ i +"']").closest("tr").remove();
                        }
                        else{
                            $("#msg").addClass("alert alert-danger");            
                            $("#msg").html("Não é possível remover, pois há um animal cadastrado com esse dono");
                        }
                });
       });
        }

        define_alterar_remover();

        $(".salvar").click(function(){ 
            if(confere_senha()){
                var senha = $("input[name='senha_cadastro']").val();
                if(senha != ""){
                    senha = $.md5(senha);
                }
                
                p = {
                    nome:$("input[name='nome_modal']").val(),
                    id_cliente: $("#id_cliente_oculto").val(),
                    cpf:$("#cpf_modal").val(),
                    telefone:$("#tel_modal").val(),
                    email:$("#email_modal").val(),
                    cod: 3,
                    senha_cadastro: senha
                };      
                
                $.post("atualizar.php",p,function(r){
                    $("#msg").removeClass("alert alert-danger");
                    $("#msg").removeClass("alert alert-info");
                    if(r=='1' || r=='2'){
                        $("#msg").addClass("alert alert-info");
                        $("#msg").html("Cliente alterado com sucesso.");
                        $(".close").click();
                        atualizar_tabela(r);                
                    }else{
                        $("#msg").addClass("alert alert-danger"); 
                        $("#msg").html("Falha ao atualizar Cliente.");
                    }
                });
            }
            else{
                $("#confirmacao_modal").addClass("alert alert-danger");
		        $("#confirmacao_modal").html("As senhas não conferem");
            }
           
       }); 

       $("input[name='trocar_senha']").change(function(){
            if($("input[name='trocar_senha']:checked").val()=='1'){
                $("#trocar_senha").fadeIn();
            }
            else{
                $("input[name='senha_cadastro']").val("");
                $("input[name='senha_confirma']").val("");
                $("#confirmacao_modal").removeClass("alert alert-danger");
		        $("#confirmacao_modal").html("");
                $("#trocar_senha").fadeOut();
                
            }
        });

        function confere_senha(){
            var senha = $("input[name='senha_cadastro']").val();
            var confirma_senha = $("input[name='senha_confirma']").val();
            
            
            if((senha === "") || (senha === confirma_senha)){
                return true;
            }
            else{
                return false;
            }
        }

       function atualizar_tabela(r){   
           if(r==='2'){
                var id = $("#id_cliente_oculto").val();
                $.get("seleciona.php?cod=3&id="+id,function(d){
                    t = "";
                    $.each(d,function(i,e){              
                        t += "<tr>";
                        t +=    "<td>"+e.nome+"</td>";
                        t +=    "<td>"+e.cpf+"</td>";
                        t +=    "<td>"+e.telefone+"</td>";
                        t +=    "<td>"+e.email+"</td>";
                        t +=    "<td>";
                        t +=        "<button class='btn btn-warning alterar' value='"+e.id_cliente+"' data-toggle='modal' data-target='#modal'>Alterar</button>";
                        t +=        " <button class='btn btn-danger remover' value='"+e.id_cliente+"'>Remover</button>";
                        t +=    "</td>";
                        t += "</tr>";
                    });            
                    $("#tbody_cliente").html(t);
                    define_alterar_remover();
                });
           }      
           else{
                $.get("seleciona.php?cod=3",function(d){
                    t = "";
                    $.each(d,function(i,e){              
                        t += "<tr>";
                        t +=    "<td>"+e.nome+"</td>";
                        t +=    "<td>"+e.cpf+"</td>";
                        t +=    "<td>"+e.telefone+"</td>";
                        t +=    "<td>"+e.email+"</td>";
                        t +=    "<td>";
                        t +=        "<button class='btn btn-warning alterar' value='"+e.id_cliente+"' data-toggle='modal' data-target='#modal'>Alterar</button>";
                        t +=        " <button class='btn btn-danger remover' value='"+e.id_cliente+"'>Remover</button>";
                        t +=    "</td>";
                        t += "</tr>";
                    });            
                    $("#tbody_cliente").html(t);
                    define_alterar_remover();
                });
           }  
            
        }
    });


</script>