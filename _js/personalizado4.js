$(function(){
	$("#pesquisa").keyup(function(){
		//Recuperar o valor do campo
		var id_local = $(this).val();
        var pesquisa = $(this).val();
		
		//Verificar se há algo digitado
		if(pesquisa != ''){
			var dados = {
                local : id_local,
				palavra : pesquisa
			}
			$.post('../_mdl/proc_venda.php', dados, function(retorna){
				//Mostra dentro da ul os resultado obtidos 
				$(".resultado").html(retorna);
			});
		}
	});
});