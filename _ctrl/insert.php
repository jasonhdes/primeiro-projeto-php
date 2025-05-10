<?php

include_once ('../_mdl/access.php');
date_default_timezone_set('UTC');

    
               
        class GetInfo {
            public static function arrayGetInfo() {
                $get = [];
                
                $get['nome'] = $_POST['nome'];
                
                
                print_r($get);
                
            }
        }
    
        
     /*   
        
        $nome      = array(utf8_encode($_POST["nome"][0]));
        $sobrenome = array(utf8_encode($_POST["sobrenome"][0]));
        $registro  = array(utf8_encode($_POST["registro"][0]));
        $local_id  = array($_POST["local"][0]);
        $telefone  = array(utf8_encode($_POST["telefone"][0]));
        $senha     = array(md5(utf8_encode($_POST["senha"][0])));
        $data      = date('Y-m-d');
        $setor     = array($_POST["setor"][0]);
        
        $result_funcionario = "INSERT INTO funcionarios ";
        $result_funcionario .= "(nome, sobrenome, registro, local_id, telefone, senha, setor_id, dataregistro) ";
        $result_funcionario .= "VALUES ";
        $result_funcionario .= "('$nome[0]', '$sobrenome[0]', '$registro[0]', '$local_id[0]', '$telefone[0]', '$senha[0]', '$setor[0]', '$data') ";

    /*$insert_funcionario = $conn->prepare($result_funcionario);
    $insert_funcionario->bindParam(':nome', $nome);
    if ($insert_funcionario->execute()) {
        $cont_insert = true;
    } else {
        $cont_insert = false;
    }*/
    /*
    $operacao_inserir = mysqli_query($conecta,$result_funcionario);
 
    
    
if(!$operacao_inserir){
    echo "<p style='color:red;'>Erro ao cadastrar<br>var_dump($nome[0],$sobrenome[0],$registro[0],$local_id[0],$telefone[0],$senha[0],
$data,$setor[0])</p>";
} else {
    echo "<p style='color:green;'>Cadastrado com Sucesso</p>";
}
    } else {
        echo "<p style='color:red;'>Preencha os campos corretamente.</p>";
    }

*/