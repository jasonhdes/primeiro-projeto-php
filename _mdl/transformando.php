<?php
    include('consultas.php');

    if($tamanho_id = $list_tamanho['tamanho_id']){
        $tamanho_nome = $list_tamanho['tamanho'];
    }

    if($cor_id = $list_cor['cor_id']){
        $cor_nome = utf8_encode($list_cor['cor']);
    }
    
    if($tecido_id_id = $list_tecido['tecido_id']){
        $tecido_nome = utf8_encode($list_tecido['tecido']);
    }

    if($local_id = $list_local['local_id']){
        $local_nome = utf8_encode($list_local['nome']);
    }
?>