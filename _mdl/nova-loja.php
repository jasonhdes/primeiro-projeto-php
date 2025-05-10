<?php

    $inserir_local = "INSERT INTO locais ";
    $inserir_local .= "(nome, endereco, estado_id, numero, complemento, telefone, cidade) ";
    $inserir_local .= "VALUES ";
    $inserir_local .= "('$nome', '$endereco', $estado, '$numero', '$complemento', '$telefone', '$cidade') ";

    $operacao_inserir = mysqli_query($conecta,$inserir_local);
 
?>