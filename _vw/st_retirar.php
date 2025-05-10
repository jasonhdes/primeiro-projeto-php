<?php
    $transportando_id = $_POST['id'];

    $buscar_transportando = "SELECT * ";
    $buscar_transportando .= "FROM transportando ";
    $buscar_transportando .= "WHERE transportando_id = {$transportando_id} ";
    $buscando_transportando = mysqli_query($conecta,$buscar_transporte);
    $resultado_transportando = mysqli_fetch_assoc($buscando_transportando);

    $codigo = $resultado_transportando['codigo'];
    $produto_quantidade = $resultado_transportando['quantidade'];
    $local_id = $resultado_transportando['local_id'];

    $buscar_qtde_estoque = "SELECT * ";
    $buscar_qtde_estoque .= "FROM estoque ";
    $buscar_qtde_estoque .= "WHERE codigo = {$codigo} AND local_id = {$local_id} ";
    $buscando_qtde_estoque = mysqli_query($conecta,$buscar_qtde_estoque);
    $resultado_qtde_estoque = mysqli_fetch_assoc($buscando_qtde_estoque);

    if(!$resultado_qtde_estoque){
        ?>
<div class="info" id="erro">Erro ao buscar estoque para devolução. Confira as informações e tente novamente.</div>
<?php
        exit();
    } else {
        $quantidade_estoque = $resultado_qtde_estoque['quantidade'];
        $estoque_id = $resultado_qtde_estoque['estoque_id'];
        $preco = $resultado_qtde_estoque['preco'];

        $nova_quantidade_estoque = ($quantidade_estoque + $produto_quantidade);
        $novo_valor_total = ($nova_quantidade_estoque * $preco);

        $alterar_estoque = "UPDATE estoque ";
        $alterar_estoque .= "SET ";
        $alterar_estoque .= "quantidade = '{$nova_quantidade_estoque}', ";
        $alterar_estoque .= "total = '{$novo_valor_total}' ";
        $alterar_estoque .= "WHERE estoque_id = {$estoque_id} ";
        $alterando_estoque = mysqli_query($conecta,$alterar_estoque);

         if(!$alterando_estoque){
             ?>
<div class="info" id="erro">Não foi possível devolver as peças ao estoque. Confira as informações e tente novamente.</div>
<?php
         } else {
             $deletar = "DELETE FROM transportando ";
             $deletar .= "WHERE transportando_id = {$transportando_id} ";
             $deletando = mysqli_query($conecta,$deletar);

             if(!$deletando) {
                 ?>
<div class="info" id="erro">Erro ao excluir peças do transporte. Confira as informações e tente novamente.</div>
<?php
             } else {
                 ?>
<div class="info" id="sucessp">Peças retiradas do transporte com sucesso.</div>
<?php
             }
         }
    }
?>