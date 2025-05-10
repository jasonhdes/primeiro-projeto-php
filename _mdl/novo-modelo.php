<?php

    $inserir_modelo = "INSERT INTO modelos ";
    $inserir_modelo .= "(nome, referencia, tamanho_id, cor_id, preco, foto, tecido_id, codigo) ";
    $inserir_modelo .= "VALUES ";
    $inserir_modelo .= "('$nome', '$referencia', $tamanho, $cor, '$preco', '$file_new', '$tecido', $nome_novo) ";

    $operacao_inserir = mysqli_query($conecta,$inserir_modelo);

?>