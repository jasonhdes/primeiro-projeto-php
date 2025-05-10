<?php
 
    $inserir_funcionario = "INSERT INTO funcionarios ";
    $inserir_funcionario .= "(nome, sobrenome, local_id, setor_id, registro, telefone, dataregistro, senha) ";
    $inserir_funcionario .= "VALUES ";
    $inserir_funcionario .= "('$nome', '$sobrenome', $local, $setor, '$registro', '$telefone', '$dataregistro', '$senha') ";

    $operacao_inserir = mysqli_query($conecta,$inserir_funcionario);
 
?>