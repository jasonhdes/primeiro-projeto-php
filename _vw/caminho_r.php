<?php
    session_start();
    include('../_mdl/access.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>ENTRAR | ko.dok</title>
        <link rel="shortcut icon" href="_img/favicon.png" type="image/x-png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <link href="_css/estilo.css" rel="stylesheet">
        <script type="text/x-javascript" src="../_js/chama-modal.js"></script>
        <style type="text/css">
            div.modal-dialog {
                border-radius: 5px;
                border: solid 2px green;
            }
            div.modal-header {
                text-align: center;
                color: green;
                background: rgb(168,255,132);
                background: linear-gradient(90deg, rgba(168,255,132,1) 0%, rgba(249,245,245,1) 50%, rgba(168,255,132,1) 100%);
            }
        </style>
    </head>
    <body>
<?php
if(isset($_POST['fechar'])){
    $cod_trnsp = $_POST['cod_transp'];
    $qtde_fechada = $_POST['quantidade_total'];
    $valr_fechada = $_POST['valor_total'];
    $data = date('d/m/Y H:i:s');
    $saida = 1;

    $fechar_saida = "UPDATE transportes ";
    $fechar_saida .= "SET ";
    $fechar_saida .= "quantidade_total = {$qtde_fechada}, ";
    $fechar_saida .= "vl_total = {$valr_fechada}, ";
    $fechar_saida .= "entrada_saida = {$saida}, ";
    $fechar_saida .= "data_transporte = '{$data}' ";
    $fechar_saida .= "WHERE codigo_transporte = {$cod_trnsp} ";
    $fechando_saida = mysqli_query($conecta,$fechar_saida);
    if(!$fechando_saida){
?>
<div class="info" id="erro">Erro ao fechar saída. Confira as informações e tente novamente.</div>
<?php
        exit();
    } else {
        $modal_titulo = "Transporte Fechado";
        $modal_mensagem = "O transporte foi fechado, veja todas as informações no romaneio.";
        $btn = "Ver Romaneio";
        $link = "romaneio.php";
        include('modal.php');
    }
}

?>
    </body>
</html>