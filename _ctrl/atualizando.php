<?php
	include_once("../_mdl/access.php");
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Confirmação | Kodok</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<link rel="stylesheet" href="../_css/estilo.css">
	</head>
	<body>
		<div class="container theme-showcase" role="main">
		<?php
          
          if(isset($_POST['atualizar'])){

        $cod        = $_POST['cod'];
        $referencia = $_POST['referencia'];
        $modelo     = $_POST['modelo'];
        $tamanho    = $_POST['tamanho'];
        $cor        = $_POST['cor'];
        $tecido     = $_POST['tecido'];
        $preco      = $_POST['preco'];
        $modelo_id  = $_POST['modelo_id'];
        $codigo     = $referencia.$tamanho.$cor;
        
        $atualizar_modelo = "UPDATE modelos ";
        $atualizar_modelo .= "SET ";
        $atualizar_modelo .= "referencia = {$referencia}, ";
        $atualizar_modelo .= "codigo = {$codigo}, ";
        $atualizar_modelo .= "nome  = '{$modelo}', ";
        $atualizar_modelo .= "tamanho_id = {$tamanho}, ";
        $atualizar_modelo .= "cor_id = {$cor}, ";
        $atualizar_modelo .= "tecido_id = {$tecido}, ";
        $atualizar_modelo .= "preco = {$preco} ";
        $atualizar_modelo .= "WHERE modelo_id = {$modelo_id} ";
        $atualizando_modelo = mysqli_query($conecta,$atualizar_modelo);
        
        if(!$atualizando_modelo){
            ?>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="myModalLabel">Erro ao cadastrar o usuário!</h4>
						</div>
						<div class="modal-body">								
							<?php echo $usuario; ?>
						</div>
						<div class="modal-footer">
							<a href="index.php"><button type="button" class="btn btn-danger">Ok</button></a>
						</div>
					</div>
				</div>
			</div>			
			<script>
				$(document).ready(function () {
					$('#myModal').modal('show');
				});
			</script>
<?php        } else {
            
            $buscar_modelo_estoque = "SELECT * ";
            $buscar_modelo_estoque .= "FROM estoque ";
            $buscar_modelo_estoque .= "WHERE codigo = {$cod} ";
            $buscando_modelo_estoque = mysqli_query($conecta,$buscar_modelo_estoque);
            
            while($resultado_modelo_estoque = mysqli_fetch_assoc($buscando_modelo_estoque)){
                
                $quantidade = $resultado_modelo_estoque['quantidade'];
                $novo_total = ($quantidade * $preco);
                
                $atualizar_modelo_estoque = "UPDATE estoque ";
                $atualizar_modelo_estoque .= "SET ";
                $atualizar_modelo_estoque .= "nome  = '{$modelo}', ";
                $atualizar_modelo_estoque .= "tamanho_id = {$tamanho}, ";
                $atualizar_modelo_estoque .= "cor_id = {$cor}, ";
                $atualizar_modelo_estoque .= "tecido_id = {$tecido}, ";
                $atualizar_modelo_estoque .= "codigo = {$codigo}, ";
                $atualizar_modelo_estoque .= "total = {$novo_total}, ";
                $atualizar_modelo_estoque .= "preco = {$preco} ";
                $atualizar_modelo_estoque .= "WHERE codigo = {$cod} ";
                $atualizando_modelo_estoque = mysqli_query($conecta,$atualizar_modelo_estoque);
                
                if(!$atualizando_modelo_estoque){
                    echo "erro atualizar estoque";
                }
            } ?>
			<!-- Modal -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="myModalLabel">Modelo atualizado com sucesso!</h4>
						</div>
						<div class="modal-body">
							<p>* Já foi também atualizado em todos os estoques.</p>
						</div>
						<div class="modal-footer">
							<a href="../_vw/modelo.php?codigo=<?php echo $codigo ?>" class="btn">Ok</a>
						</div>
					</div>
				</div>
			</div>				
			<script>
				$(document).ready(function () {
					$('#myModal').modal('show');
				});
			</script>
		<?php 
                } 
    }
        
?>
	
		</div>
	</body>
</html>