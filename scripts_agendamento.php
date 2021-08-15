<script>
    $(function(){
        function define_alterar_remover(){ 
            $(".alterar").click(function(){
                i = $(this).val();
                $("#id_agendamento_oculto").val(i);
                $.get("seleciona.php?cod=5&id="+i,function(r){
                    a = r[0];
                    $("select[name='cliente_modal']").val(a.cod_cliente);

                    $("input[name='data_modal']").val(a.dia);
                    
                    $.post("select_animal.php",{cliente:a.cod_cliente},function(pets){
                        
                        texto = "<option value=\"\">::Selecione o Animal::</option>";
                        $.each(pets.pet,function(i,v){
                            texto += "<option value=" +v.id_animal+ ">" +v.nome+ "</option>";
                        });
                        
                        $("#animal_modal").html(texto);
                        $("#animal_modal").val(a.cod_animal);
                    });

                    $.post("select_hora.php",{data:a.dia,"cod_animal":a.cod_animal},function(horarios){
                        
                        tamanho = horarios.length;
                        texto = "<option value=\"\">::Selecione a Hora::</option>";
                        for(var i=0; i<tamanho; i++){
                            texto += "<option value=\"" +horarios[i]+ "\">" +horarios[i]+ "</option>";
                        }
                        $("#horario_modal").html(texto);
                        $("#horario_modal").val(a.hora);
                    });
                    
                    
                });
            });

            $("#cliente_modal").change(function(){
                var cliente = $("#cliente_modal").val();
                $.post("select_animal.php",{"cliente":cliente},function(pets){
                    texto = "<option value=\"\">::Selecione o Pet::</option>";
                    $.each(pets.pet,function(i,v){
                        texto += "<option value=" +v.id_animal+ ">" +v.nome+ "</option>";
                    });
                    $("#animal_modal").html(texto);
                });
            });

            $("#data_modal").blur(function(){
                var data = $("#data_modal").val();
                var cod_animal = $("#animal_modal").val();
                $.post("select_hora.php",{"data":data,"cod_animal":cod_animal},function(horarios){
                    tamanho = horarios.length;
                    texto = "<option value=\"\">::Selecione o Horário::</option>";
                    for(var i=0; i<tamanho; i++){
                        texto += "<option value=" +horarios[i]+ ">" +horarios[i]+ "</option>";
                    }
                    $("#horario_modal").html(texto);
                });
                
            });

            $(".remover").click(function(){
                i = $(this).val();
                c = "id_agendamento";
                t = "agendamento";
                p = {tabela:t,id:i,coluna:c}
                $.post("remover.php",p,function(r){
                        $("#msg").removeClass("alert alert-danger");
                        $("#msg").removeClass("alert alert-info");
                        if(r=='1'){                
                            $("#msg").addClass("alert alert-info");
                            $("#msg").html("Agendamento removido com sucesso.");
                            $("button[value='"+ i +"']").closest("tr").remove();
                        }
                });
            });
        }

        define_alterar_remover();

        $(".salvar").click(function(){ 
            p = {
                animal:$("select[name='animal_modal']").val(),
                data:$("input[name='data_modal']").val(),
                hora:$("select[name='horario_modal']").val(),
                id_agendamento:$("#id_agendamento_oculto").val(),
                cod: 5
            };       

            $.post("atualizar.php",p,function(r){
                $("#msg").removeClass("alert alert-danger");
                $("#msg").removeClass("alert alert-info");
                if(r=='1' || r=='2'){
                    $("#msg").addClass("alert alert-info");
                    $("#msg").html("Agendamento alterado com sucesso.");
                    $(".close").click();
                    atualizar_tabela(r);                
                }
                else{
                    $("#msg").addClass("alert alert-danger"); 
                    $("#msg").html("Falha ao atualizar Agendamento.");
                }
            });
        }); 

        function atualizar_tabela(r){  
            var id = $("#id_agendamento_oculto").val(); 
            if(r==='2'){
                $.get("seleciona.php?cod=5&id="+id,function(r){
                    t = "";
                    $.each(r,function(i,a){ 
                        d = moment(a.dia).format("DD/MM/YYYY");          
                        t += "<tr>";
                        t +=    "<td>"+a.nome_cliente+"</td>";
                        t +=    "<td>"+a.telefone+"</td>";
                        t +=    "<td>"+a.nome_animal+"</td>";
                        t +=    "<td>"+a.nome_raca+"</td>";
                        t +=    "<td>"+d+"</td>";
                        t +=    "<td>"+a.hora+"</td>";
                        t +=    "<td>";
                        t +=        "<button class='btn btn-warning alterar' value='"+a.id_agendamento+"' data-toggle='modal' data-target='#modal'>Alterar</button>";
                        t +=        " <button class='btn btn-danger remover' value='"+a.id_agendamento+"'>Remover</button>";
                        t +=    "</td>";
                        t += "</tr>";
                    });            
                    $("#tbody_agendamento").html(t);
                    define_alterar_remover();
                });
            }   
            else{
                $.get("seleciona.php?cod=5",function(r){
                    t = "";
                    $.each(r,function(i,a){ 
                        d = moment(a.dia).format("DD/MM/YYYY");          
                        t += "<tr>";
                        t +=    "<td>"+a.nome_cliente+"</td>";
                        t +=    "<td>"+a.telefone+"</td>";
                        t +=    "<td>"+a.nome_animal+"</td>";
                        t +=    "<td>"+a.nome_raca+"</td>";
                        t +=    "<td>"+d+"</td>";
                        t +=    "<td>"+a.hora+"</td>";
                        t +=    "<td>";
                        t +=        "<button class='btn btn-warning alterar' value='"+a.id_agendamento+"' data-toggle='modal' data-target='#modal'>Alterar</button>";
                        t +=        " <button class='btn btn-danger remover' value='"+a.id_agendamento+"'>Remover</button>";
                        t +=    "</td>";
                        t += "</tr>";
                    });            
                    $("#tbody_agendamento").html(t);
                    define_alterar_remover();
                });
            }     
            
        }
    });


</script>