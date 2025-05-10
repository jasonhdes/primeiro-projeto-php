<?php
    require_once ("../_mdl/access.php");
    date_default_timezone_set('Etc/GMT+3');

    if(isset($_POST["nome"])){
        $nome         = utf8_decode($_POST["nome"]);
        $sobrenome    = utf8_decode($_POST["sobrenome"]);
        $local        = $_POST["local"];
        $setor        = $_POST["setor"];
        $registro     = utf8_decode($_POST["registro"]);
        $telefone     = utf8_decode($_POST["telefone"]);
        $dataregistro = date('Y-m-d');
        $senha        = md5(utf8_decode($_POST["senha"]));
    }
 
    require('../_mdl/novo-funcionario.php');
 
    if(!$operacao_inserir){
        header('Location: ../_vw/erro.php');
    } else {
        header('Location: ../_vw/registrado.php');
    }
?>