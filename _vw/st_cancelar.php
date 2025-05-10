<?php
    $buscar_estoque_local = "SELECT * ";
    $buscar_estoque_local .= "FROM transportando ";
    $buscar_estoque_local .= "WHERE codigo_transporte = {$resultado_transporte['codigo_transporte']} ";
    $buscando_estoque_local = mysqli_query($conecta,$buscar_estoque_local);
    while($resultado_estoque_local = mysqli_fetch_assoc($buscando_estoque_local)){
        $estoque_retorno = $resultado_transporte['local_id'];
        $codigo_retorno = $retorno_estoque_local['codigo'];
        $quantidade_retorno = $resultado_estoque_local['quantidade'];
        $transportando_id = $resultado_estoque_local['transportando_id'];
        $preco_estoque = $resultado_estoque_local['preco'];

        $buscar_estoque = "SELECT * ";
        $buscar_estoque .= "FROM estoque ";
        $buscar_estoque .= "WHERE local_id = {$estoque_retorno} ";
        $buscar_estoque .= "AND codigo = {$codigo_retorno} ";
        $buscando_estoque = mysqli_query($conecta,$buscar_estoque);
        $resultado_estoque = mysqli_fetch_assoc($buscando_estoque);

        $quantidade_estoque = $resultado_estoque['quantidade'];
        $quantidade_nova = ($quantidade_estoque + $quantidade_retorno);
        $novo_total = ($preco_estoque * $quantidade_nova);

        $devolver_estoque = "UPDATE estoque ";
        $devolver_estoque .= "SET ";
        $devolver_estoque .= "quantidade = {$quantidade_nova}, ";
        $devolver_estoque .= "total = {$novo_total} ";
        $devolver_estoque .= "WHERE local_id = {$estoque_retorno} ";
        $devolver_estoque .= "AND codigo = {$codigo_retorno} ";
        $devolvendo_estoque = mysqli_query($conecta,$devolver_estoque);

        $excluir_transportando = "DELETE ";
        $excluir_transportando .= "FROM transportando ";
        $excluir_transportando .= "WHERE transportando_id = {$transportando_id} ";
        $excluindo_transportando = mysqli_query($conecta,$excluir_transportando);
        if(!$excluindo_transportando){
            ?>
<div class="info" id="erro">Erro ao cancelar transporte. Confira as informações e tente novamente.</div>
<?php
        } else {
            header('Location: transporte.php');
        }
    }
?>