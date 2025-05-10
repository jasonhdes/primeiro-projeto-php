<?php

include_once ('../_mdl/access.php');
date_default_timezone_set('UTC');

    if(isset($_POST["nome"])){
       
        $nome      = $_POST["nome"];
        $sobrenome = $_POST["sobrenome"];
        $registro  = $_POST["registro"];
        $local_id  = $_POST["local"];
        $telefone  = $_POST["telefone"];
        $senha     = md5('$_POST["senha"]');
        $setor     = $_POST["setor"];
        $data      = date('Y-m-d');
        
        $result_funcionario = "INSERT INTO funcionarios ";
        $result_funcionario .= "(nome, sobrenome, registro, local_id, telefone, senha, setor_id, dataregistro) ";
        $result_funcionario .= "VALUES ";
        $result_funcionario .= "('$nome', '$sobrenome', '$registro', '$local_id', '$telefone', '$senha', '$setor', '$data') ";

    /*$insert_funcionario = $conn->prepare($result_funcionario);
    $insert_funcionario->bindParam(':nome', $nome);
    if ($insert_funcionario->execute()) {
        $cont_insert = true;
    } else {
        $cont_insert = false;
    }*/
    
    $operacao_inserir = mysqli_query($conecta,$result_funcionario);
 
    
    
if(!$operacao_inserir){
    echo "<p style='color:red;'>Erro ao cadastrar<br>print_r(array)</p>";
} else {
    echo "<p style='color:green;'>Cadastrado com Sucesso</p>";
}
    } else {
        echo "<p style='color:red;'>Preencha os campos corretamente.</p>";
    }