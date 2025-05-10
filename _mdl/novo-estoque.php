<?php
    $codigo_id = "SELECT * ";
    $codigo_id .= "FROM modelos ";
    $codigo_id .= "WHERE codigo = '{$codigo}' ";

    $lista_codigo = mysqli_query($conecta, $codigo_id);
    $list_codigo = mysqli_fetch_assoc($lista_codigo);
    
    $cor     = $list_codigo['cor_id'];
    $tamanho = $list_codigo['tamanho_id'];
    $tecido  = $list_codigo['tecido_id'];
    $preco   = $list_codigo['preco'];
    $modelo  = $list_codigo['nome'];
    $total   = ($quantidade * $preco);

    $inserir_estoque = "INSERT INTO estoque ";
    $inserir_estoque .= "(local_id, codigo, quantidade, cor_id, tamanho_id, tecido_id, preco, nome, total) ";
    $inserir_estoque .= "VALUES ";
    $inserir_estoque .= "($local_id, $codigo, $quantidade, $cor, $tamanho, $tecido, $preco, '$modelo', $total) ";

    $operacao_estoque = mysqli_query($conecta,$inserir_estoque);
    if(!$operacao_estoque){
        echo "<script type=\"text/javascript\">alert('Houve algum erro. Adicionar ao estoque. print_r($_POST);');</script>";
    } else {
        echo "<script type=\"text/javascript\">alert('Adicionado com sucesso!');</script>";
    }
?>