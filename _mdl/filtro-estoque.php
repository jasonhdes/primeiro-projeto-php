<?php

    

    $tam_id = $row_estoque['tamanho_id'];
    $color_id     = $row_estoque['cor_id'];
    $tec_id  = $row_estoque['tecido_id'];
    $codigo_ref = $row_estoque['codigo'];
    $qtde_estoq = $row_estoque['quantidade'];
    $valores    = $row_estoque['preco'];
    $nome_model = utf8_encode($row_estoque['nome']);

    

    if($tam_id = $list_tamanho['tamanho_id']){
        $tamanho_nom = $list_tamanho['tamanho'];
    }

    if($color_id = $list_cor['cor_id']){
        $cor_nom = utf8_encode($list_cor['cor']);
    }
    
    if($tec_id = $list_tecido['tecido_id']){
        $tecido_nom = utf8_encode($list_tecido['tecido']);
    }
?>