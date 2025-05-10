<?php    
    $consulta   = "SELECT * ";
    $consulta   .= "FROM estoque ";
    $consulta   .= "WHERE estoque_id = '{$estoque}' ";
    $mais_estoque    = mysqli_query($conecta,$consulta);
 
    $dados_estoque  = mysqli_fetch_assoc($mais_estoque);
    $quantidade_atual = $dados_estoque["quantidade"];
    $vl_unit = $dados_estoque['preco'];
    

    $nova_quantidade = ($quantidade_atual + $quantidade);
    $novo_valor_total = ($nova_quantidade * $vl_unit);

    $inserir_quantidade = "UPDATE estoque ";
    $inserir_quantidade .= "SET ";
    $inserir_quantidade .= "quantidade = '{$nova_quantidade}', ";
    $inserir_quantidade .= "total = '{$novo_valor_total}' ";
    $inserir_quantidade .= "WHERE estoque_id = {$estoque} ";

    $operacao_inserir = mysqli_query($conecta,$inserir_quantidade);
    if(!$operacao_inserir){
        echo "<script type=\"text/javascript\">alert('Houve algum erro. Adicionar ao estoque. print_r($_POST);');</script>";
    } else {
        echo "<script type=\"text/javascript\">alert('Adicionado com sucesso!');</script>";
    }
?>