<?php
    require_once ("../_mdl/access.php");

    if(isset($_POST["modelo"])){
        $nome       = utf8_decode($_POST["modelo"]);
        $referencia = utf8_decode($_POST["referencia"]);
        $tamanho    = $_POST["tamanho"];
        $cor        = $_POST["cor"];
        $preco      = utf8_decode($_POST["preco"]);
        $tecido     = $_POST["tecido"];
    
        if(isset($_FILES['upload_file'])) {
            $arquivo_temporario = $_FILES['upload_file']['tmp_name'];
            $arquivo = basename($_FILES['upload_file']['name']);
            $extensao  = strtolower(strrchr($_FILES['upload_file']['name'],"."));
            $nome_novo = $referencia.$tamanho.$cor;
            $diretorio = "../_img/fotos_modelos/";
            
            move_uploaded_file($arquivo_temporario,$diretorio.$nome_novo);
        
            $file_new = $diretorio.$nome_novo;
        }
        
 
    require('../_mdl/novo-modelo.php');

    }

    if(!$operacao_inserir){
        header('Location: ../_vw/erro.php');
    } else {
        header ("location: ../_vw/adicionar-modelo.php");
        echo "Novo Modelo salvo.";
    }
?>