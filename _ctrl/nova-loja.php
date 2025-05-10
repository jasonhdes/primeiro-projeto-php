<?php
    require_once ("../_mdl/access.php");

    if(isset($_POST["nome"])){
        $nome        = utf8_decode($_POST["nome"]);
        $endereco    = utf8_decode($_POST["endereco"]);
        $estado      = $_POST["estado"];
        $numero      = $_POST["numero"];
        $complemento = utf8_decode($_POST["complemento"]);
        $telefone    = utf8_decode($_POST["telefone"]);
        $cidade      = utf8_decode($_POST["cidade"]);
    }
 
    require('../_mdl/nova-loja.php');

    if(!$operacao_inserir){
        header('Location: ../_vw/erro.php');
    } else {
        header('Location: ../_vw/registrado.php');
    }
?>