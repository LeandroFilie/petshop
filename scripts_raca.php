<script>
    $(function(){
        function define_alterar_remover(){ 
            $(".alterar").click(function(){
                i = $(this).val();
                $("#id_raca_oculto").val(i);
                $.get("seleciona.php?cod=2&id="+i,function(r){
                    e = r[0];
                    $("#nome_modal").val(e.nome_raca);
                    $("#especie_modal").val(e.cod_especie);
                });
            });

            $(".remover").click(function(){
                i = $(this).val();
                c = "id_raca";
                t = "raca";
                p = {tabela:t,id:i,coluna:c}
                $.post("remover.php",p,function(r){
                        $("#msg").removeClass("alert alert-danger");
                        $("#msg").removeClass("alert alert-info");
                        if(r=='1'){  
                            $("#msg").addClass("alert alert-info");              
                            $("#msg").html("Raça removida com sucesso.");
                            $("button[value='"+ i +"']").closest("tr").remove();
                        }
                        else{
                            $("#msg").addClass("alert alert-danger");            
                            $("#msg").html("Não é possível remover, pois há um animal cadastrado com essa raça");
                        }
                    });
            }); 
        }

        define_alterar_remover();

        $(".salvar").click(function(){ 
           p = {
                nome:$("input[name='nome_modal']").val(),
                cod_especie:$("select[name='especie_modal']").val(),
                id_raca: $("#id_raca_oculto").val(),
                cod: 2
           };      
           
           $.post("atualizar.php",p,function(r){
            $("#msg").removeClass("alert alert-danger");
            $("#msg").removeClass("alert alert-info");
            if(r=='1'){
                $("#msg").addClass("alert alert-info");
                $("#msg").html("Raça alterada com sucesso.");
                $(".close").click();
                atualizar_tabela();                
            }else{
                $("#msg").addClass("alert alert-danger"); 
                $("#msg").html("Falha ao atualizar Raça.");
            }
           });
       }); 

       function atualizar_tabela(){           
            $.get("seleciona.php?cod=2",function(r){
                t = "";
                $.each(r,function(i,e){              
                    t += "<tr>";
                    t +=    "<td>"+e.nome_raca+"</td>";
                    t +=    "<td>"+e.nome_especie+"</td>";
                    t +=    "<td>";
                    t +=        "<button class='btn btn-warning alterar' value='"+e.id_raca+"' data-toggle='modal' data-target='#modal'>Alterar</button>";
                    t +=        " <button class='btn btn-danger remover' value='"+e.id_raca+"'>Remover</button>";
                    t +=    "</td>";
                    t += "</tr>";
                });            
                $("#tbody_raca").html(t);
                define_alterar_remover();
            });
        }
    });


</script>