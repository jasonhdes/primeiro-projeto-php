<?php
    $estado = "SELECT * ";
    $estado .= "FROM estados ";
    $estado .= "ORDER BY estado ASC ";
    $lista_estado = mysqli_query($conecta, $estado);
    $list_estado = mysqli_fetch_assoc($lista_estado);
    mysqli_data_seek($lista_estado, '0');

    $local = "SELECT * ";
    $local .= "FROM locais ";
    $local .= "ORDER BY local_id ASC ";
    $lista_local = mysqli_query($conecta, $local);
    $list_local = mysqli_fetch_assoc($lista_local);
    mysqli_data_seek($lista_local, '0');

    $setor = "SELECT * ";
    $setor .= "FROM setores ";
    $setor .= "ORDER BY setor_id ASC ";
    $lista_setor = mysqli_query($conecta, $setor);    
    $list_setor = mysqli_fetch_assoc($lista_setor);
    mysqli_data_seek($lista_setor, '0');

    $cor = "SELECT * ";
    $cor .= "FROM cores ";
    $cor .= "ORDER BY cor ASC ";
    $lista_cor = mysqli_query($conecta, $cor); 
    $list_cor = mysqli_fetch_assoc($lista_cor);
    mysqli_data_seek($lista_cor, '0');

    $tamanho = "SELECT * ";
    $tamanho .= "FROM tamanhos ";
    $tamanho .= "ORDER BY tamanho_id ASC ";
    $lista_tamanho = mysqli_query($conecta, $tamanho);
    $list_tamanho = mysqli_fetch_assoc($lista_tamanho);
    mysqli_data_seek($lista_tamanho, '0');

    $tecido = "SELECT * ";
    $tecido .= "FROM tecidos ";
    $tecido .= "ORDER BY tecido ASC ";
    $lista_tecido = mysqli_query($conecta, $tecido);
    $list_tecido = mysqli_fetch_assoc($lista_tecido);
    mysqli_data_seek($lista_tecido, '0');

    $modelo = "SELECT * ";
    $modelo .= "FROM modelos ";
    $modelo .= "ORDER BY codigo ASC ";
    $lista_modelo = mysqli_query($conecta, $modelo); 
    $list_modelo = mysqli_fetch_assoc($lista_modelo);
    mysqli_data_seek($lista_modelo, '0');

    $estoque = "SELECT * ";
    $estoque .= "FROM estoque ";
    $estoque .= "ORDER BY codigo ASC ";
    $lista_estoque = mysqli_query($conecta, $estoque); 
    $list_estoque = mysqli_fetch_assoc($lista_estoque);
    mysqli_data_seek($lista_estoque, '0');
?>